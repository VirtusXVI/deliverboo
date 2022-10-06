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
                                    <button class="d-block button is-success btn btn-outline-info" :disabled="!menu.is_visible" @click="addToCart(menu)">Aggiungi <i class="fa-solid fa-cart-shopping"></i></button>
                                    <div v-if="!menu.is_visible">Piatto non disponibile</div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="not-same-restaurant" v-if="!same_restaurant">
            <div class="pop-up">
                <div>
                    Stai inserendo nel carrello un piatto di un altro ristorante. <br>
                    Questa operazione svuoterà il carrello, vuoi proseguire?
                </div>

                <div>
                    <button class="btn btn-outline-info" @click="btnConfirm(menu)">Conferma</button>

                    <button class="btn btn-outline-info" @click="btnAbort()">Annulla</button>
                </div>
            </div>
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
                menuRestaurant: [],
                same_restaurant: true,
                emptyArray: []
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
                let actualCart = JSON.parse(localStorage.getItem('cart'));
                console.log(actualCart.length);
                if(actualCart.length > 0){
                    if(menu.user_id == actualCart[0].user_id){
                        this.$store.commit('addToCart', menu);
                    }else{
                        this.same_restaurant = false;
                    }
                }else if(actualCart.length < 1){
                    this.$store.commit('addToCart', menu);
                }
            },

            btnAbort(){
                this.same_restaurant = true;
            },

            btnConfirm(){
                let actualCart = JSON.parse(localStorage.getItem('cart'));
                let actualCartCount = JSON.parse(localStorage.getItem('cartCount'));
                actualCart = [];
                actualCart = JSON.stringify(actualCart);
                actualCartCount = 0;
                localStorage.setItem('cartCount', actualCartCount);
                localStorage.setItem('cart', actualCart);
                this.same_restaurant = true;
                window.location.reload();
            }
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
        .not-same-restaurant{
            position: fixed;
            top: 0;
            left: 0;
            right:0;
            bottom: 0;
            height: 100vh;
            z-index: 999999;
            background-color: rgba(0, 0, 0, 0.22);
        }
        .pop-up{
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            border: 5px solid $mainFirstColor;
            width: 700px;
            height: 30vh;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            align-items: center;
        }
    }
</style>