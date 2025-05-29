import { createRouter, createWebHistory } from '@ionic/vue-router';
import { RouteRecordRaw } from 'vue-router';
import EmailVerified from "./middlewares/emailVerified";
import Auth from "./middlewares/auth";
import Guest from "./middlewares/guest";
import {useUserStore} from "@/store/user";
import {useCookies} from "@vueuse/integrations/useCookies";
import {getCsrf} from "@/api/user";
import GuestLayout from "@/views/Layouts/Guest-Layout.vue";
import AuthLayout from "@/views/Layouts/Auth-Layout.vue";


const routes: Array<RouteRecordRaw> = [
  {
      path : "/login",
      component: GuestLayout,
      children : [
        {
          path: '',
          name: 'login',
          component: () => import('@/views/Authentication/LoginPage.vue'),
          meta:{middleware: [Guest]}
        }
      ]
  },
  {
    path:'/dashboard',
    redirect:'/dashboard/home'
  },
  {
      path:'/dashboard',
      name: 'dashboard',
      component: AuthLayout,
      children:[
        {
          path:'home',
          name: 'home',
          component: () => import('@/views/Dashboard/MainDashboardView.vue'),
          meta:{middleware: [Auth]}
        },
        {
          path:'account',
          name: 'account',
          component: () => import('@/views/Dashboard/UserAccount.vue'),
          meta:{middleware: [Auth]}
        }
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
  history: createWebHistory(import.meta.env.BASE_URL),
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

router.beforeEach(async (to, from, next) => {
  const cookies = useCookies();
  if(!cookies.get('XSRF-TOKEN')){
    await getCsrf();
  }
  return next();
});


export default router
