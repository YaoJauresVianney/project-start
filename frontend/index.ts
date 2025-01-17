import { createApp } from "vue";
import App from "./App.vue";
import router from "./plugins/router";
import pinia from "./plugins/pinia";
import vuetify from "./plugins/vuetify";
import GuestLayout from "./layouts/GuestLayout.vue";
import AuthLayout from "./layouts/AuthLayout.vue";
import "./src/app.css";

const app = createApp(App);

app.component('guest-layout', GuestLayout);
app.component('auth-layout', AuthLayout);

app.use(vuetify);

app.use(pinia);

app.use(router);

app.mount('body');