import {EventInterface} from "@/types/events";
import Request from "@/plugins/request";
import {useAxios} from "@vueuse/integrations/useAxios";
import {useAlertsStore} from "@/store/alerts";
export const useEventComposable = () => {
    const alerts = useAlertsStore();
    const signToEvent = async (event : EventInterface) : Promise<void> => {
        try {
            const { execute } = useAxios(`/api/events/${event.uuid}/sign-up`, {method: 'POST'}, Request, {
                immediate: false
            });
            const response = await execute();
        }catch (error) {
            alerts.addAlert('Error', 'Failed to sign up for the event. Please try again later.', 5000, 'error');
            throw error;
        }
    }
    return {
        signToEvent
    }
}