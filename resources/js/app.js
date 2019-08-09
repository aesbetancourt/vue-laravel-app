import Vue from 'vue'
import VueRouter from 'vue-router'
import { HasError, AlertError, Form } from 'vform'
import VueProgressBar from 'vue-progressbar'

require('./bootstrap');

// Vue Configs
window.Vue = require('vue');
// vform config
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// Uses
Vue.use(VueRouter);
Vue.use(VueProgressBar, {
    color: 'rgb(0, 64, 255)',
    failedColor: 'red',
    height: '3px'
});

// Configuring Vue Router
const routes =[
    {path: "/dashboard", component: require('./components/Dashboard.vue').default},
    {path: "/profile", component: require('./components/Profile').default},
    {path: "/users", component: require('./components/Users').default},
];

const router = new VueRouter({
    mode: 'history',
    routes
});

const app = new Vue({
    el: '#app',
    router
});
