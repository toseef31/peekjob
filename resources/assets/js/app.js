
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
import VueSocketio from 'vue-socket.io';
import socketio from 'socket.io-client'

window.Vue = require('vue');
Vue.use(VueSocketio,socketio(':6999'));
import VueRouter from 'vue-router'
import Vue from 'vue';
import VueNoty from 'vuejs-noty'
 
Vue.use(VueNoty)
Vue.use(VueRouter)

const home = require('./components/Example.vue');
const perpost = require('./components/showpostComponents.vue');

const routes = [
    {
        path: '/',
        component: home
    },
    {
        path: '/perpost/:userId/:post_id',
        name: 'article',
        component: perpost,
        props: true
    },
    ];

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const router= new VueRouter({
    routes
});
const app = new Vue({
    el: '#app',
    router,
});
