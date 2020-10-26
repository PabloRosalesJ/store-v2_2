import VueRouter from 'vue-router'

let routes = [
    {
        path: '/',
        name: 'root',
        component: require('./components/ExampleComponent.vue').default
    },
    {
        path: '/clients',
        name: 'clients',
        component: require('./views/users/Clients.vue').default
    },
    {
        path: '/providers',
        name: 'providers',
        component: require('./views/users/Providers.vue').default
    },
    {
        path: '/users',
        name: 'users',
        component: require('./views/users/Users.vue').default
    }
]

export default new VueRouter({
    routes,
    mode: 'history'
})