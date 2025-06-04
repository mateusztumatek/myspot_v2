import axios, {AxiosError} from 'axios';
import {RequestError} from "@/plugins/requestError";
import { useCookies } from '@vueuse/integrations/useCookies'
import {useAlertsStore, Alert} from "@/store/alerts";
import {$t} from "@/plugins/i18n";
import router from "@/router";

const service = axios.create({
    baseURL: process.env.VUE_APP_API_URL,
    timeout: 600000, // Request timeout
    withCredentials: true,
    withXSRFToken: true
});


service.interceptors.request.use(
    config => {
        config.headers['Accept-Language'] = localStorage.getItem('locale');
        const cookies = useCookies();
        config.headers['X-XSRF-TOKEN'] = cookies.get('XSRF-TOKEN');
        return config;
    },
    error => {
        Promise.reject(error);
    }
);
service.interceptors.response.use(
    response => {
        return response.data;
    },
    error => {
        console.log('ON REJECT', error);
        if(error.response.status == 422){
            error.validationError = new RequestError(error.response.data.errors, error.response.data.message);
            return Promise.reject(error);
        }
        if(error.response.status == 429){
            const alerts = useAlertsStore();
            alerts.addAlert('error.too_many_request_title', $t('error.too_many_request_message.'), 5000, 'error');
        }
        if(error.response.status == 401){
            const alerts = useAlertsStore();
            alerts.addAlert($t('error.authorization_required_title'), $t('error.authorization_required_message'), 5000, 'error');
            router.push('/login');
        }
        return Promise.reject(error);
    },
);

export default service;

export function reportAxiosError(error: AxiosError){
    console.error(error)
}
