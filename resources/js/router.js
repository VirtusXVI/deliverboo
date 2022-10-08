import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


import HomePage from './pages/HomePage.vue';
import Categories from './pages/Categories.vue';
import RestaurantMenu from './pages/RestaurantMenu.vue';
import MenuDetails from './pages/MenuDetails.vue';
import Checkout from './pages/Checkout.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/categorie',
            name: 'categorie',
            component: Categories
        },
        {
            path: '/ristorante/:slug',
            name: 'menu',
            component: RestaurantMenu
        },
        {
            path: '/menu-ristorante/dettagli-piatto/:slug',
            name: 'dish',
            component: MenuDetails
        },
        {
            path: '/checkout',
            name: 'checkout',
            component: Checkout
        }
    ]
});

export default router;