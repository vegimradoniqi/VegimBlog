/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import Vue from 'vue';
import VueRouter from "vue-router";
import routes from "./routes";
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import moment from 'moment'

Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(VueRouter);
Vue.use(BootstrapVue);
Vue.use(IconsPlugin);


Vue.filter('formatDate', function(value) {
    if (value) {
        return moment(String(value)).format('DD MMMM YYYY')
    }
})

new Vue({
    el: '#app',
    router: new VueRouter(routes)
});
