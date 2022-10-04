import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


import HomePage from './pages/HomePage.vue';
import Categories from './pages/Categories.vue';
import RestaurantMenu from './pages/RestaurantMenu.vue';
import MenuDetails from './pages/MenuDetails.vue';

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
            path: '/menu-ristorante/:id',
            name: 'menu',
            component: RestaurantMenu
        },
        {
            path: '/menu-ristorante/dettagli-piatto/:slug',
            name: 'dish',
            component: MenuDetails
        }
    ]
});

export default router;