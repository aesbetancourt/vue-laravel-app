import Vue from 'vue';
import VueRouter from 'vue-router';
import { HasError, AlertError, Form } from 'vform';
import VueProgressBar from 'vue-progressbar';
import swal from 'sweetalert2';


require('./bootstrap');

// Vue Configs
window.Vue = require('vue');
//SweetAlert configs
window.swal = swal;
const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.toast = toast;

// vform config
window.Form = Form;
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);

// Progress bar config

Vue.use(VueProgressBar, {
    color: 'rgb(0, 64, 255)',
    failedColor: 'red',
    height: '3px'
});

// Configuring Vue Router
Vue.use(VueRouter);
const routes =[
    {path: "/dashboard", component: require('./components/Dashboard.vue').default},
    {path: "/profile", component: require('./components/Profile').default},
    {path: "/users", component: require('./components/Users').default},
];

const router = new VueRouter({
    mode: 'history',
    routes
});

//

window.Fire =  new Vue();

const app = new Vue({
    el: '#app',
    router
});
