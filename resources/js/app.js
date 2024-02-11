import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import jQuery from 'jquery';
import calendar from "../views/home/partials/calendar.blade.vue"

import {createApp} from 'vue/dist/vue.esm-bundler';
const app = createApp({});

const $ = jQuery;
window.$ = $;

// todo - why every page
app.component('calendar',calendar)


if ($('#vue-app-teacher').length>0){ app.mount('#vue-app-teacher') }
if ($('#vue-app-admin-dashboard').length>0){ app.mount('#vue-app-admin-dashboard') }
//vue-application
