/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'
import { Form, HasError, AlertError } from 'vform'
import Swal from 'sweetalert2'

window.Form = Form;

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.use(VueRouter)

const routes = [
    { path: '/fo', component: require('./components/frontoffice.vue').default },//front office
    { path: '/rs', component: require('./components/reservations.vue').default }, //reservations
    { path: '/fm', component: require('./components/floormanager.vue').default }, //floormanager
    { path: '/hk', component: require('./components/housekeeping.vue').default }, //housekeeping
    { path: '/in', component: require('./components/inventory.vue').default }, //inventory
    { path: '/gu', component: require('./components/guestprofile.vue').default }, //guests rate management usermanagement floormanagement userlog reports
    { path: '/gs', component: require('./components/guests.vue').default }, //guests rate management usermanagement floormanagement userlog reports
    { path: '/rm', component: require('./components/ratemanagement.vue').default }, //
    { path: '/um', component: require('./components/housekeeping.vue').default }, //
    { path: '/fm', component: require('./components/housekeeping.vue').default }, //
    { path: '/lg', component: require('./components/housekeeping.vue').default }, //
    { path: '/rp', component: require('./components/housekeeping.vue').default }, //
    //{ path: '/rs', component: require('./components/reservations.vue').default },
]

const router = new VueRouter({
    mode : 'history',
    routes // short for `routes: routes`
  })

Vue.filter('upText', function (text) {
    return text.charAt(0).toUpperCase()+text.slice(1);
})

const options = {
    color: '#8de08d',
    failedColor: '#d93232',
    thickness: '7px',
    transition: {
      speed: '0.2s',
      opacity: '0.6s',
      termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
  }

Vue.use(VueProgressBar, options);

window.Swal = Swal;

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})

window.Toast = Toast;
let Fire = new Vue();
window.Fire = Fire;

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('frontoffice', require('./components/frontoffice.vue').default);
Vue.component('reservations', require('./components/reservations.vue').default);
Vue.component('floormanager', require('./components/floormanager.vue').default);
Vue.component('housekeeping', require('./components/housekeeping.vue').default);
Vue.component('guests', require('./components/guests.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
