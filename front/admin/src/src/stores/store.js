import { defineStore } from "pinia";

export const userStore = defineStore({
    id: 'user',
    state: () => ({
        user: null
    }),
    actions: {
        set(data) {
            this.user = data;
        },
    },
    getters: {

        get() {
            return this.user;
        },
    }
})
