import Vue from 'vue'
import VueRouter from 'vue-router'
import { HasError, AlertError, Form } from 'vform'

require('./bootstrap');

// Vue Configs
window.Vue = require('vue');
// vform config
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// Uses
Vue.use(VueRouter);

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
