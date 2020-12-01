require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import Sidebar from './components/Sidebar';
import * as VueGoogleMaps from "vue2-google-maps";
import ScrollLoader from 'vue-scroll-loader';
import FavoriteButton from './components/FavoriteButton';

window.VBus = new Vue();

const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueRouter);
Vue.use(ScrollLoader);

Vue.use(VueGoogleMaps, {
    load: {
        key: 'AIzaSyADRgkZvLE3XwYgRlAz3PMd6B1Erk9fAgE',
        libraries: "places,drawing,visualization", // necessary for places input
        region: "uk,en"
    }
});

new Vue({
    el: '#app',
    router,
    mounted() {
        require('./phone-mask');
    },
    components: {
        Sidebar,
        FavoriteButton,
    }
});