require('./bootstrap');

window.Vue = require('vue');
import VueRouter from 'vue-router'
import VueProgressBar from 'vue-progressbar'
import { Form, HasError, AlertError } from 'vform'
import Swal from 'sweetalert2'

window.Form = Form;

import $ from 'jquery';
window.$ = window.jQuery = $;
import dt from 'datatables.net';
window.dt = dt;

import 'jquery-ui/ui/widgets/datepicker.js';

Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.use(VueRouter)

import Gate from "./Gate";

Vue.prototype.$gate = new Gate(window.user);
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
// Install BootstrapVue
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// This imports all the layout components such as <b-container>, <b-row>, <b-col>:
import { LayoutPlugin } from 'bootstrap-vue'
Vue.use(LayoutPlugin)

// This imports <b-modal> as well as the v-b-modal directive as a plugin:
import { ModalPlugin } from 'bootstrap-vue'
Vue.use(ModalPlugin)

// This imports <b-card> along with all the <b-card-*> sub-components as a plugin:
import { CardPlugin } from 'bootstrap-vue'
Vue.use(CardPlugin)

// This imports directive v-b-scrollspy as a plugin:
import { VBScrollspyPlugin } from 'bootstrap-vue'
Vue.use(VBScrollspyPlugin)

// This imports the dropdown and table plugins
import { DropdownPlugin, TablePlugin } from 'bootstrap-vue'
Vue.use(DropdownPlugin)
Vue.use(TablePlugin)

const routes = [
    { path: '/fo', component: require('./components/frontoffice.vue').default },//front office
    { path: '/rs', component: require('./components/reservations.vue').default }, //reservations
    { path: '/fm', component: require('./components/floormanager.vue').default }, //floormanager
    { path: '/hk', component: require('./components/housekeeping.vue').default }, //housekeeping
    { path: '/in', component: require('./components/inventory.vue').default }, //inventory
    { path: '/gu', component: require('./components/guestprofile.vue').default }, //guests rate management usermanagement floormanagement userlog reports
    { path: '/gs', component: require('./components/guests.vue').default }, //guests rate management usermanagement floormanagement userlog reports
    { path: '/rm', component: require('./components/ratemanagement.vue').default }, //
    { path: '/um', component: require('./components/users.vue').default }, //
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
    require('./components/NotFound.vue').default
);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('frontoffice', require('./components/frontoffice.vue').default);
Vue.component('reservations', require('./components/reservations.vue').default);
Vue.component('floormanager', require('./components/floormanager.vue').default);
Vue.component('housekeeping', require('./components/housekeeping.vue').default);
Vue.component('guests', require('./components/guests.vue').default);
Vue.component('users', require('./components/users.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
