require('./bootstrap');

import Vue from 'vue';
import VueRouter from 'vue-router';
import routes from './routes';
import Sidebar from './components/Sidebar';

const router = new VueRouter({
    mode: 'history',
    routes
});

Vue.use(VueRouter);

Vue.component('sidebar', Sidebar);

new Vue({
    el: '#app',
    router,
});