<template>
    <button @click="logout">Logout</button>
</template>

<script>
import {logout} from "@/api/api";

export default {
    name: 'BookLoans',
    data() {
        return {
            credentials: {
                email: '',
                password: '',
            },
        };
    },
    methods: {
        /** start of logout  import {logout} from "@/api/api"; **/
        async logout() {
            const isLoggedOut = await logout();

            if (isLoggedOut) {
                await this.$router.push('/login');
            } else {
                console.error('Logout failed');
            }
        },
    },


};
</script>
