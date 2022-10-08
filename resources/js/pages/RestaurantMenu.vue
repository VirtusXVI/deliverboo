<template>
    <main class="restaurant-menu">
        <div class="img-restaurant-menu">
            <img v-if="restaurantDetails.restaurant_image" :src="'/storage/' + restaurantDetails.restaurant_image"  :alt="restaurantDetails.restaurant_name">
            <img v-else 
            src="https://c4.wallpaperflare.com/wallpaper/596/763/771/artwork-painting-nighthawks-edward-hopper-wallpaper-preview.jpg" 
            alt="Default Image">
        </div>
        <Cart />
        <div class="menu-restaurant container">
            <ul class="menu-list row row-cols-1 row-cols-md-2 row-cols-xl-3">
                <li v-for="menu, index in menuRestaurant" :key="index" class="col mb-3">
                    <div class="card">
                        <div class="image">
                            <img v-if="menu.dish_image" class="card-img-top" :src="'/storage/' + menu.dish_image" :alt="menu.name">
                            <img v-else src="https://s3-eu-west-1.amazonaws.com/tpd/logos/55be6ade0000ff000581b457/0x0.png" alt="no-pic-found">
                        </div>
                        <div class="dish-details">
                            <div class="card-body d-flex flex-column justify-content-between">

                                <div class="desc-cont">
                                    <div class="description">
                                        <h5 class="title">{{menu.name}}</h5>
                                        <div class="price">
                                            <span><strong>Prezzo:</strong></span>
                                            <p class="card-text">{{menu.price}} &euro;</p>
                                        </div>
                                    </div>
                                    <div class="button-view">
                                        <button class="btn ms-btn" @click="setActiveElement(index)">Scopri dettagli</button>
                                    </div>
                                </div>
                                
                                <div class="text-center button-cart">
                                    <button class="d-block button is-success btn btn-outline-info" :disabled="!menu.is_visible" @click="addToCart(menu)">Aggiungi <i class="fa-solid fa-cart-shopping"></i></button>
                                    <div v-if="!menu.is_visible" class="pt-2" style="color: grey">Piatto non disponibile</div>
                                </div>

                                <div :id="index" v-if="index == currentActiveElement" class="dish-view-container">
                                    <div class="dish-view d-flex flex-column">
                                        <div class="dish-menu-general">
                                            <div>
                                                <h2>{{menu.name}}</h2>
                                            </div>
                                            <div>{{menu.description}}</div>
                                        </div>
                                        <div class="dish-menu-details d-flex flex-column">
                                            <div class="price-menu">
                                                <h4>Prezzo: {{menu.price}} &euro;</h4> 
                                            </div>
                                            <div class="ingredients">
                                                <h5>Ingredienti: {{menu.ingredients}}</h5>
                                            </div>                
                                        </div>
                                        <button class="checkout-btn btn" @click="currentActiveElement = 99">Chiudi</button>
                                    </div>
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
                restaurantDetails: [],
                menuRestaurant: [],
                same_restaurant: true,
                emptyArray: [],
                currentActiveElement: 99,
                currentPage: 1,
                lastPage: null,
                firstPage: 1,
            }
        },

        methods: {
            getDishes() {
                axios.get('/api/ristorante/' + this.$route.params.slug)
                .then((response) => {
                    this.restaurantDetails = response.data.results[0];
                    this.menuRestaurant = response.data.results[0].dish;
                    console.log(this.restaurantDetails);
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
            },
            setActiveElement(element) {
                if(element !== this.currentActiveElement) {
                    this.currentActiveElement = element;
                }
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

        .img-restaurant-menu {
            margin-bottom: 20px;
            img {
                display: block;
                margin: 0;
                padding: 0;
                width: 100%;
                height: 300px;
                object-fit: cover;
                object-position: center;
            }
        }
    
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

            width: 60%;
            margin: 0 auto;
    
            .menu-list {
                
                .col {
                    min-height: 300px;
                    .card{
                        height: 100%;
                        border-radius: 15px;
                        .image {
                            height: 150px;
                            background-color: rgba(0, 0, 0, 0.22);
                            border-top-left-radius: 14px;
                            border-top-right-radius: 14px;
                            flex-grow: 0;

                            img {
                                width: 100%;
                                height: 100%;
                                object-fit: cover;
                                object-position: center;
                                border-top-left-radius: 14px;
                                border-top-right-radius: 14px;
                            }
                        }
                        .card-body {
                            flex-grow: 1;
                            
                            .dish-view-container {
                                position: fixed;
                                top: 0;
                                left: 0;
                                right:0;
                                bottom: 0;
                                height: 100vh;
                                z-index: 999999;
                                background-color: rgba(0, 0, 0, 0.22);
                                .dish-view {
                                    position: fixed;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    background-color: white;
                                    padding: 80px 80px 30px 80px;
                                    border-radius: 15px;
                                    border: 5px solid $mainFirstColor;
                                    width: 800px;
                                    height: 50vh;
                                    
                                    .dish-menu-general {
                                        flex-grow: 0;
                                        padding-bottom: 15px;
                                    }

                                    .dish-menu-details {
                                        flex-grow: 4;

                                        .price-menu {
                                            flex-grow: 0;
                                            padding-bottom: 10px;
                                        }

                                        .ingredients {
                                            flex-grow: 4;
                                        }
                                    }

                                    .checkout-btn {
                                        background-color: $mainSecondColor;
                                        height: 30px;
                                        width: 40%;
                                        font-weight: 600;
                                        display: block; 
                                        margin: 10px auto;
                                    }
                                }
                            }

                            .desc-cont {
                                // position: relative;
                                display: flex;
                                flex-wrap: wrap;

                                flex-grow: 1;
                                .button-view {
                                    width: 120px;
                                    margin: 0 auto;

                                    .ms-btn {
                                        border: trasparent;
                                        background-color: $mainSecondColor;
                                        padding: 5px 10px;
                                        cursor: pointer;
                                        border-radius: 12px;
                                        width: 100%;
                                    }
                                }

                                .description {
                                    padding: 10px;
                                    width: calc(100% - 120px);
                                    min-width: 50%;
                                    flex-grow: 1;               

                                    .title {
                                        height: 24px;
                                        overflow: hidden;
                                        padding-right: 10px;
                                    }
                                }
                            }
                        }
                    }
                }
                
            }
        }
    
        .button-cart {
            margin-top: 20px;
            margin-inline: auto;
            flex-grow: 0;

            button {
                width: 105px;
                margin: 0 auto;
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