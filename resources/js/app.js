import Vue from 'vue';
import VueRouter from 'vue-router';
import { HasError, AlertError, Form } from 'vform';
import VueProgressBar from 'vue-progressbar';
import swal from 'sweetalert2';
import Gate from './Gate';

Vue.prototype.$gate = new Gate(window.user);
window.axios = require('axios');

// let token = document.head.querySelector('meta[name="csrf-token"]');

// if (token) {
//     window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
// } else {
//     console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
// }

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

Vue.component('pagination', require('laravel-vue-pagination'));

// Progress bar config

Vue.use(VueProgressBar, {
    color: 'rgb(0, 64, 255)',
    failedColor: 'red',
    height: '3px'
});

// Configuring Vue Router
Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);
Vue.component(
    'not-found',
    require('./components/NotFound').default
);

Vue.component(
    'upload-fi',
    require('./components/UploadFiles.vue').default

);

Vue.component(
    'view-file',
    require('./components/FilesView.vue').default

);


Vue.use(VueRouter);
const routes = [
    { path: "/dashboard", component: require('./components/Dashboard.vue').default },
    { path: "/developer", component: require('./components/Developer.vue').default },
    { path: "/profile", component: require('./components/Profile').default },
    { path: "/users", component: require('./components/Users').default },
    { path: "/upload-fil", component: require('./components/UploadFiles').default },
    { path: "/view-fil", component: require('./components/FilesView').default },
    { path: "*", component: require('./components/NotFound').default },


];

const router = new VueRouter({
    mode: 'history',
    routes
});

//

window.Fire = new Vue();


const app = new Vue({
    el: '#app',
    router
});
