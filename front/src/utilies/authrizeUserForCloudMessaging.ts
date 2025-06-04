import {getToken, getMessaging} from 'firebase/messaging';
import {useAxios} from "@vueuse/integrations/useAxios";
import {reportAxiosError} from "@/plugins/request";
import Request from "@/plugins/request";

export async function retrieveAndSetUserDevice(): Promise<string> {
    try {
        const permission = await Notification.requestPermission();
        if (permission !== 'granted') {
            throw new Error('Notification permission not granted');
        }

        const messaging = getMessaging();
        const currentToken = await getToken(messaging, {
            vapidKey: 'BD0rZfHwXQxUXyRu5L9a8RqInONQAJjLDXV1ffQH20CQWf1MteFmCtiphtedrZThTgpg3jT1ZNnVrDolB3pyhDw',
        });

        if (currentToken) {
            await useAxios(
                'api/user/notification-channels',
                {
                    method: 'POST',
                    data: { type: 'push', meta: { token: currentToken } },
                },
                Request
            );
            return currentToken;
        } else {
            throw new Error('No token received');
        }
    } catch (error : any) {
        reportAxiosError(error);
        throw error;
    }
}
