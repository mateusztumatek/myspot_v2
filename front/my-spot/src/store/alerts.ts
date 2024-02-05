import { defineStore } from 'pinia'
import {reactive} from "vue";

export class Alert{

    public isActive;

    public message;

    public title;

    // Default alert time
    public time;

    public type;

    constructor(title : string, message : string, time : number, type = 'success') {
        this.message = message;
        this.time = time;
        this.title = title;
        this.type = type;
        this.isActive = false;
    }
    start() {
        this.isActive = true;
        setTimeout(() => {
            this.isActive = false;
        }, this.time)
    }

    close(){
        this.isActive = false;
    }

}

export const useAlertsStore = defineStore('alerts', {
    state: (): { alerts : any[]} => ({
        alerts: [],
    }),
    actions: {
        addAlert(title : string, message : string, time : number | null, type = 'success'): void {
            const alert = reactive(new Alert(title, message, time ?? 5000, type));
            this.alerts.push(alert);
            alert.start();
        },
    },
    getters:{
        activeAlerts : (state) => state.alerts.filter(alert => alert.isActive)
    }
})
