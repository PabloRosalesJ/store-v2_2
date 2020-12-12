import VueRouter from 'vue-router'

let routes = [
    //  #usuarios
    {
        path: '/',
        name: 'root',
        component: require('./components/ExampleComponent.vue').default
    },
    {
        path: '/user/cliente',
        name: 'clients',
        component: require('./views/users/Clients.vue').default
    },
    {
        path: '/user/cliente/:id',
        name: 'client',
        component: require('./views/users/Client.vue').default
    },
    {
        path: '/user/provedor',
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

    //  #Ventas
    {
        path: '/ventas',
        name: 'allSales',
        component: require('./views/sales/Sales.vue').default
    },
    {
        path: '/ventas/hacer-venta',
        name: 'makeSale',
        component: require('./views/sales/MakeSale.vue').default
    },
    {
        path: '/ventas/creditos',
        name: 'allCredits',
        component: require('./views/sales/Credits.vue').default
    },
    {
        path: '/ventas/hacer-venta-credito',
        name: 'makeCredit',
        component: require('./views/sales/MakeCredit.vue').default
    },

    //  #Almacén
    {
        path: '/almacén/categorias',
        name: 'allCategories',
        component: require('./views/store/Categories.vue').default
    },
    {
        path: '/almacén/productos',
        name: 'allProducts',
        component: require('./views/store/Products.vue').default
    },
    {
        path: '/almacén/producto/:id',
        name: 'productDetails',
        component: require('./components/Store/Products/ProductDetailsComponent.vue').default
    },
    {
        path: '/almacén/ingresos',
        name: 'allIncomes',
        component: require('./views/store/Incomes.vue').default
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