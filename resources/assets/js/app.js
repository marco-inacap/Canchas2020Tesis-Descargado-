

require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue'
import Vuetify from 'vuetify'
import VueScheduler from 'v-calendar-scheduler';
import Notifications from 'vue-notification'
import EventBus from './EventBus'

import moment from 'moment'
import 'v-calendar-scheduler/lib/main.css';
import Router from 'vue-router';
/* import router from './Router/router.js'; */

Vue.use(Vuetify)
Vue.use(Notifications)
Vue.use(VueScheduler,{locale: 'es',
labels: {
    today: 'Hoy',
    back: 'Atrás',
    next: 'Siguiente',
    month: 'Mes',
    week: 'Semana',
    day: 'Día',
    all_day: 'Todo el día'
 },
 initialDate: new Date()
})

import User from './Helpers/User'
window.User = User
Vue.prototype.$bus = EventBus
Vue.prototype.moment = moment
/* 
 Vue.use(Router);  */




/* import router from './Router/router.js'; */



/*  Vue.component('example-component', require('./components/ExampleComponent.vue')); */

const app = new Vue({
    el: '#app',
    router
}); 

