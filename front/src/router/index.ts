import {createRouter, createWebHistory, RouteRecordRaw} from 'vue-router'
import HomeView from '../views/HomeView.vue'
import GuestLayout from "@/views/Layouts/Guest-Layout.vue";
import Guest from './middlewares/guest'
import Auth from './middlewares/auth'
import EmailVerified from '@/router/middlewares/emailVerified'
import AuthLayout from "@/views/Layouts/Auth-Layout.vue";
import VerifyEmailPage from "@/views/Authentication/VerifyEmailPage.vue";
import {useUserStore} from "@/store/user";

const routes: Array<RouteRecordRaw> = [
    {
        path: '',
        redirect: '/dashboard',
    },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: AuthLayout,
        children: [
            {
                path: '/dashboard',
                name: 'dashboard',
                component: () => import('@/views/Dashboard/Account-Panel.vue'),
                meta: {middleware: [EmailVerified, Auth]}
            },
            {
                path: '/verify-email',
                name: 'Verify Email',
                component:() => import('@/views/Authentication/VerifyEmailPage.vue'),
            }
        ]
    },
    {
        path: '/about',
        name: 'about',
        // route level code-splitting
        // this generates a separate chunk (about.[hash].js) for this route
        // which is lazy-loaded when the route is visited.
        component: () => import(/* webpackChunkName: "about" */ '../views/AboutView.vue')
    },
    {
        path: '',
        name: 'Authentication Routes',
        component: GuestLayout,
        children: [
            {
                path: '/login',
                name: 'Login',
                component: () => import('@/views/Authentication/Login-Page.vue'),
                meta: {
                    middleware: [Guest]
                },
            },
            {
                path: '/forget-password',
                name: 'Forget password',
                component: () => import('@/views/Authentication/ForgotPasswordPage.vue'),
                meta: {
                    middleware: [Guest]
                },
            },
            {
                path: '/reset-password',
                name: 'Reset password',
                component: () => import('@/views/Authentication/ResetPasswordPage.vue'),
                meta: {
                    middleware: [Guest]
                },
            },
        ]
    },
    {
        path:'/404',
        name: 'PageNotFound',
        component: GuestLayout,
        children: [
            {
                path: '/404',
                name: '404',
                component: () => import('@/views/Errors/404Page.vue'),
            }
        ]
    },
    { path: '/:pathMatch(.*)*', redirect: '/404' },

]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

function nextFactory(context : { from : any, next : any, router : any, to : any }, middleware : any, index : any) {
    const subsequentMiddleware = middleware[index]  // If no subsequent Middleware exists,
    // the default `next()` callback is returned.
    if (!subsequentMiddleware) return context.next;

    return (parameters: [{ from : any, next: any, router: any, to: any }]) => {
        // Run the default Vue Router `next()` callback first.
        context.next(...parameters);
        // Then run the subsequent Middleware with a new
        // `nextMiddleware()` callback.
        const nextMiddleware = nextFactory(context, middleware, index + 1);
        subsequentMiddleware({...context, next: nextMiddleware});
    };
}

router.beforeEach(async (to, from, next) => {
    if(to.query.refreshUser){
        const userStore= useUserStore();
        await userStore.refreshUser();
    }
    if (to.meta.middleware) {
        const middleware = Array.isArray(to.meta.middleware)
            ? to.meta.middleware
            : [to.meta.middleware];
        const context = {
            from,
            next,
            router,
            to,
        };
        const nextMiddleware = nextFactory(context, middleware, 1);

        return middleware[0]({...context, next: nextMiddleware});
    }
    return next();
})


export default router
