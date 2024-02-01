import { defineStore } from 'pinia'
import {getCsrf, login, logout, me} from "@/api/user";
import {useStorage} from "@vueuse/core";
import router from '@/router';
import {Axios, AxiosError} from "axios";

const defaultNotAuthenticatedUser = {
    email: '',
    name: '',
    id: null,
    email_verified_at : null
}
export const useUserStore = defineStore('user', {
    state: ()  => ({
        user : useStorage<User>('user', defaultNotAuthenticatedUser),
    }),
    actions: {
        async login(email: string, password: string): Promise<User> {
            try {
                const user = await login(email, password);
                this.user = user;
                return this.user;
            } catch (error: any) {
                throw error.validationError;
            }
        },

        /**
         * Logs out the user by performing necessary clean-up and navigation.
         *
         * @return {Promise<boolean>} true if the user is successfully logged out
         */
        async logout(): Promise<boolean> {
            await logout();
            this.user = defaultNotAuthenticatedUser;
            router.push('/login');
            return true;
        },

        async refreshUser(): Promise<void> {
            await getCsrf();
            const user = await me();
            this.user = user;
        },

        /**
         * Set the user for the function.
         *
         * @param {User} user - The user object to be set
         * @return {void}
         */
        setUser(user: User) {
            this.user = user
        }
    },
    getters: {
        isLoggedIn : (state) => {
            return state.user.id
        },
        hasVerifiedEmail : (state) => {
            return state.user.email_verified_at !== null
        }
    },
})

