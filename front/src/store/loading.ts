import { defineStore } from 'pinia'

export const useLoadingStore = defineStore('loading', {
    state: () => ({
        loading: false,
    }),
    actions: {
        startLoading(): void {
            this.loading = true
        },
        stopLoading(): void {
            this.loading = false
        },
    },
    getters: {
        isLoading: (state) => state.loading,
    },
})