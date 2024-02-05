import {useUserStore} from "@/store/user";

export default ({ from, next, router, to }: { from: any; next: any; router: any; to: any }) => {
    const store = useUserStore();
    console.log('IS LOGGED IN', store.isLoggedIn);
    if(!store.isLoggedIn){
        router.push('/login');
    }
    return next();
}