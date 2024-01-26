import axios from 'axios';
import {RequestError} from "@/plugins/requestError";
const service = axios.create({
    baseURL: process.env.VUE_APP_API_URL,
    timeout: 600000, // Request timeout
    withCredentials: false
});

// response pre-processing

service.interceptors.request.use(
    config => {
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
        if(error.status == 422){
            return new RequestError(error.response.data.errors);
        }
        return Promise.reject(error);
    },
);

export default service;
