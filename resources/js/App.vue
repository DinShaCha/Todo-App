<template>
    <v-app class="bg-login">
        <v-app-bar color="surface" elevation="2" style="min-width: 300px;">
            <v-container>
                <v-row dense class="align-center">
                    <router-link :to="isLogged ? '/dashboard' : '/'" class="d-flex align-center no-underline">
                        <!-- App Icon by Icons8 -->
                        <v-app-bar-title class="align-center d-flex" v-if="$vuetify.display.width > 400">
                            <span class="ml-3 align-center">
                                <span class="font-weight-bold text-primary">MyTodo</span>
                                <span class="font-weight-light text-black">List</span>
                            </span>
                        </v-app-bar-title>
                    </router-link>

                    <v-spacer />
        
                    <v-btn v-if="isLogged" @click="logout" color="primary">Logout</v-btn>
                    <v-btn v-if="isGuest" to="/login" color="primary">Login</v-btn>
                    <v-btn v-if="isGuest" to="/register" color="primary">Register</v-btn>
                </v-row>
            </v-container>
        </v-app-bar>

        <v-main>
            <router-view />
        </v-main>

    </v-app>
</template>

<script>
import store from './store';

export default {
    data() {
        return {
            appName: import.meta.env.VITE_APP_NAME,
            drawer: false,
        };
    },
    computed: {
        isMobile() {
            return this.$vuetify.display.smAndDown;
        },
        isLogged() {
            return store.isLoggedIn;
        },
        isGuest() {
            return !store.isLoggedIn;
        },
    },
    methods: {
        logout() {
            store.logout();
        },
    },
};
</script>
