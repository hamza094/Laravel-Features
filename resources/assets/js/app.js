
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import InstantSearch from 'vue-instantsearch';
Vue.use(InstantSearch);

import VueStarRating from 'vue-star-rating';

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component('review-form', require('./components/ReviewForm.vue'));

Vue.component('reply', require('./components/Reply.vue'));


Vue.component('star-rating',VueStarRating);

const app = new Vue({
    el: '#app'
});
