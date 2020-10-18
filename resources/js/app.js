require('./bootstrap');

window.Vue = require('vue');

Vue.component(
    'example-component',
    require('./components/ExampleComponent.vue').default
);
Vue.component(
    'content-component',
    require('./components/ContentComponent.vue').default
);



const app = new Vue({
    el: '#app',
    router,

});
