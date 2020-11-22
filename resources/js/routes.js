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
        path: '/provedor',
        name: 'providers',
        component: require('./views/users/Providers.vue').default
    },
    {
        path: '/usuario',
        name: 'users',
        component: require('./views/users/Users.vue').default
    },
    {
        path: '/usuario/:id',
        name: 'usersShops',
        component: require('./views/users/User.vue').default
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