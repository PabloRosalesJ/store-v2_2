import VueRouter from 'vue-router'

let routes = [
    {
        path: '/',
        name: 'root',
        component: require('./components/ExampleComponent.vue').default
    },
    {
        path: '/cliente',
        name: 'clients',
        component: require('./views/users/Clients.vue').default
    },
    {
        path: '/cliente/:id',
        name: 'client',
        component: require('./views/users/Client.vue').default
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
    },
    {
        path: '*',
        name: 'notFound',
        component: require('./views/errors/404.vue').default
    },
    {
        // will match anything starting with `/user-`
        path: '/client/*',
        component: require('./views/errors/404.vue').default
    }
]

export default new VueRouter({
    routes,
    mode: 'history'
})