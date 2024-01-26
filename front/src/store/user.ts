import { defineStore } from 'pinia'
import {login} from "@/api/user";

export const useUserStore = defineStore('user', {
    state: (): { user: User | null }  => ({
        user : null,
    }),
    actions: {
        login(email : string, password : string): Promise<any> {
            return new Promise((resolve, reject) => {
                login(email, password).then((user : User) => {
                    this.user = user;
                    resolve(this.user);
                }).catch(error => {
                    console.log('SIEMA', error);
                    reject(error);
                })
            })
        },
    },
    getters: {

    },
})

