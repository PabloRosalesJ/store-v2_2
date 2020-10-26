
// require('./bootstrap');

// window.Vue = require('vue');

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


import './bootstrap'

import router from './routes'

const app = new Vue({
    el: '#app',
    router,
});
