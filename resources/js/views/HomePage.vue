<template>
    <v-container>
        <v-row>
            <v-col cols="12" lg="6" offset-lg="3">
                <v-card>
                    <v-row class="pa-6">
                        <v-col>
                            <h1 style="text-align: center;">{{ appName }}</h1>
                                    <v-btn color="primary" block class="mt-4" to="/login">Login</v-btn>
                                    <v-btn color="primary" block class="mt-4" to="/register">Register</v-btn>
                        </v-col>
                    </v-row>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>

export default {
    data() {
        return {
            appName: import.meta.env.VITE_APP_NAME,
        };
    },
};
</script>