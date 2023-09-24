import './bootstrap';

import {createApp} from "vue";

import App from './components/app.vue';

import router from './router/index.js';

let app= createApp(App);

app.use(router);

app.mount("#app");
