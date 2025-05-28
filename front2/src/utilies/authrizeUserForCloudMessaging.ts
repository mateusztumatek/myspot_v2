import {getToken, getMessaging} from 'firebase/messaging';
import {useAxios} from "@vueuse/integrations/useAxios";
import {reportAxiosError} from "@/plugins/request";
import Request from "@/plugins/request";

export function retriveAndSetUserDevice () : Promise<string> {
    return new Promise((resolve, reject) => {
        const messaging = getMessaging();
        return getToken(messaging, {vapidKey: 'BD0rZfHwXQxUXyRu5L9a8RqInONQAJjLDXV1ffQH20CQWf1MteFmCtiphtedrZThTgpg3jT1ZNnVrDolB3pyhDw'}).then((currentToken) => {
            if(currentToken){
                useAxios('api/user/notification-channels', {'method' : "POST", data: {type: 'push', meta:{token: currentToken}}}, Request).then(response => {
                    resolve(currentToken);
                }).catch(error => {
                    reportAxiosError(error)
                });
            }
            return currentToken;
        })
    })
}