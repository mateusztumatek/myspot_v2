import axios from 'axios';
import {RequestError} from "@/plugins/requestError";
import { useCookies } from '@vueuse/integrations/useCookies'
import {useAlertsStore, Alert} from "@/store/alerts";

const service = axios.create({
    baseURL: process.env.VUE_APP_API_URL,
    timeout: 600000, // Request timeout
    withCredentials: true,
    withXSRFToken: true
});


service.interceptors.request.use(
    config => {
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
        if(error.response.status == 422){
            error.validationError = new RequestError(error.response.data.errors, error.response.data.message);
            return Promise.reject(error);
        }
        if(error.response.status == 429){
            const alerts = useAlertsStore();
            alerts.addAlert('Slow down', 'You request application too many times.', 5000, 'error');
        }
        return Promise.reject(error);
    },
);

export default service;
