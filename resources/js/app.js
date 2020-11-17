require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import Sidebar from './components/Sidebar';
import * as VueGoogleMaps from "vue2-google-maps";

const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueRouter);

Vue.component('sidebar', Sidebar);
Vue.use(VueGoogleMaps, {
    load: {
        key: process.env.GOOGLE_MAPS_API_KEY,
        libraries: "places,drawing,visualization", // necessary for places input
        region: "uk,en"
    }
});

new Vue({
    el: '#app',
    router,
    mounted() {
        require('./phone-mask');
    }
});