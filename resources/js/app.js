
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform'
import moment from 'moment'

import swal from 'sweetalert2'
window.swal = swal;

const toast = swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });

window.toast = toast;

window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


Vue.component('pagination', require('laravel-vue-pagination'));

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'

Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '3px'
})

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
let routes = [

  ]


Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('conditions', require('./files/conditions.vue'));
Vue.component('questions', require('./files/questions.vue'));
Vue.component('tests', require('./files/tests.vue'));
Vue.component('milks', require('./files/milks.vue'));

Vue.component('screenings', require('./files/screenings.vue'));
Vue.component('requestings', require('./files/requestings.vue'));

Vue.component('client', require('./users/client.vue'));
Vue.component('admins', require('./users/admins.vue'));
Vue.component('candidates', require('./users/candidates.vue'));
Vue.component('doctors', require('./users/doctors.vue'));
Vue.component('donors', require('./users/donors.vue'));
Vue.component('staff', require('./users/staff.vue'));
Vue.component('nurses', require('./users/nurses.vue'));
Vue.component('recipients', require('./users/recipients.vue'));

Vue.component('donate', require('./users/donate.vue'));
Vue.component('request', require('./users/request.vue'));

Vue.component('profile1', require('./users/profile1.vue'));
Vue.component('profile2', require('./users/profile2.vue'));
Vue.component('profile3', require('./users/profile3.vue'));

Vue.component('changepassword', require('./users/changepassword.vue'));

Vue.component('requestreport', require('./reports/request.vue'));
Vue.component('donationreport', require('./reports/donation.vue'));

Vue.component('claimed', require('./reports/claimed.vue'));
Vue.component('expired', require('./reports/expired.vue'));
Vue.component('donated', require('./reports/donated.vue'));

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

Vue.filter('capText', function(text){
  return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate', function(created) {
  return moment(created).format('MMMM Do YYYY, h:mm:ss A');
});

Vue.filter('myDate2', function(created) {
  return moment(created).format('MMMM Do YYYY');
});

let Fire = new Vue();
window.Fire = Fire;

const app = new Vue({
    el: '#app',
    router
});
