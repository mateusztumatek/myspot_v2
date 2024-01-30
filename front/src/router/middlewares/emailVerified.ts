import {useUserStore} from "@/store/user";

export default ({ from, next, router, to }: { from: any; next: any; router: any; to: any }) => {
    const store= useUserStore();
    if(!store.hasVerifiedEmail){
        router.push('/verify-email');
    }
    return next();
}