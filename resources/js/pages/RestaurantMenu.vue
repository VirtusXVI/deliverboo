<template>
    <main class="restaurant-menu">
        <div class="jumbotron">
            immagine ristorante
        </div>
        <Cart />
        <div class="menu-restaurant container">
            <ul class="menu-list flex">
                <li v-for="menu, index in menuRestaurant" :key="index">
                    <div class="card">
                        <div v-if="menu.dish_image" class="image">
                            <img class="card-img-top" :src="menu.dish_image" :alt="menu.name">
                        </div>
                        <div class="dish-details">
                            <div class="card-body">
                                <div class="description">
                                    <div class="title">
                                        <span><strong>{{menu.name}}</strong></span>
                                    </div>
                                    <div class="price">
                                        <span><strong>Prezzo:</strong></span>
                                        <p class="card-text">{{menu.price}} &euro;</p>
                                    </div>
                                </div>

                                <div class="button">
                                    <router-link 
                                        :to="{
                                            name: 'dish', 
                                            params: {slug: menu.slug}
                                        }" class="d-block ms-btn">Scopri dettagli 
                                    </router-link>
                                    <button class="d-block button is-success btn btn-outline-info" :disabled="!menu.is_visible" @click="addToCart(menu)">Add to Cart</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </main>
</template>

<script>
import Cart from '../components/Cart.vue'
    export default {
        name: 'RestaurantMenu',

        components: {
            Cart,
        },

        data() {
            return {
                menuRestaurant: []
            }
        },
    
        methods: {
            getDishes() {
                axios.get('/api/piatti/' + this.$route.params.id)
                .then((response) => {
                    this.menuRestaurant = response.data.results;
                })
            },

            addToCart(menu) {
                this.$store.commit('addToCart', menu);
            },
        },
    
        mounted() {
             this.getDishes();
        }
    }
</script>
<style lang="scss">
    @import '../common/commons.scss';
    @import '../common/variables.scss';
    
    .restaurant-menu {
        margin-top: 50px;
    
        .menu-general {
            width: 80%;
        }
    
        .menu-details {
            padding-top: 50px;
            margin-left: 100px;
            width: 20%;
            text-align: left;
    
            .price {
                text-align: left;
            }
        }
    
        .menu-restaurant{
    
            .menu-list {
                flex-wrap: wrap;
                max-width: 300px;
            }
        }
    
        .button {
            margin-top: 20px;
            margin-inline: auto;
            .ms-btn {
                border: trasparent;
                background-color: $mainSecondColor;
                padding: 6px 20px;
                cursor: pointer;
                border-radius: 12px;
    
            }
    
            a:hover {
                color: inherit;
            }
        }
    }
</style>