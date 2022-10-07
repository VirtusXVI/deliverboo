<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <div class="navbar-link ms-cart mb-3" href="" onclick="document.querySelector('.cart-view-container').style.display='block'">
            Il mio Carrello<span class="d-inline-block" :class="{'span-center-single' : $store.state.cartCount < 10, 'span-center-double' : $store.state.cartCount >= 10}">{{ $store.state.cartCount }}</span>
        </div>

        <div class="cart-view-container navbar-dropdown is-boxed is-right">
            <div class="cart-view">
                <div class="view-legenda row row-cols-3 w-100 text-center">
                    <div class="col">Piatto</div>
                    <div class="col">Seleziona Quantità</div>
                    <div class="col">Prezzo</div>
                </div>
                <hr class="navbar-divider mb-2">
                <div class="cart-items-cont">
                    <div  v-for="menu in $store.state.cart" :key="menu.id" class="cart-items navbar-item row row-cols-3 text-center pb-3" href="">
                        <div class="col">{{ menu.name }}</div> 
                        <div class="col">
                            <button type="button" class="btn btn-danger btn-number" data-type="minus" title="Remove from cart" @click.prevent="decreaseQuantityFromCart(menu)">
                                <i class="fa-solid fa-minus"></i>
                            </button>
                            <div class="fake-input">{{menu.quantity}}</div>
                            <button type="button" class="btn btn-success btn-number"  data-type="plus" title="Remove from cart" @click.prevent="increaseQuantityFromCart(menu)">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </div>
                        
                        <div class="col d-flex justify-content-between">
                            <div></div>
                            <div class="pl-5">{{ menu.totalPrice }}&euro;</div>
                            <button type="button" class="btn mr-2" title="Remove from cart" @click.prevent="removeFromCart(menu)">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>                
                <div v-if="$store.state.cart.length > 0" class="checkout navbar-dropdown is-boxed is-right">
                    <div class="d-flex w-25 mx-auto justify-content-between">
                        <div>Totale:</div>
                        <div>{{ totalPrice }}&euro;</div>
                    </div>

                    <hr class="navbar-divider">

                    <a class="checkout-btn btn navbar-item" href="">Checkout</a>
                </div>

                <div v-else class="navbar-dropdown is-boxed is-right">Il carrello è vuoto</div>

                <span onclick="document.querySelector('.cart-view-container').style.display='none'" class="cross"><i class="fa-solid fa-xmark"></i></span>
            </div>

            
        </div>
    </div>
</template>

<script>
export default {
    name: 'Cart',

    methods: {
        removeFromCart(menu) {
            this.$store.commit('removeFromCart', menu);
        },
        decreaseQuantityFromCart(menu) {
            this.$store.commit('decreaseQuantityFromCart', menu);
        },
        increaseQuantityFromCart(menu) {
            this.$store.commit('increaseQuantityFromCart', menu);
        }
    },

    computed: {
    totalPrice() {
        let total = 0;

        for (let menu of this.$store.state.cart) {
            total += parseFloat(menu.totalPrice);
        }
        
        return parseFloat(total).toFixed(2);
    }
}
}
</script>

<style lang="scss" scoped>
@import '../common/commons.scss';
@import '../common/variables.scss';
// .removeBtn {
//     font-size: 20px;
//     margin-right: 1rem;
//     color: red;
// }

.has-dropdown {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    padding-right: 30px;

    .cart-view-container {
        position: fixed;
        top: 0;
        left: 0;
        right:0;
        bottom: 0;
        height: 100vh;
        display: none;
        z-index: 999999;
        background-color: rgba(0, 0, 0, 0.22);
        .cart-view {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            border: 5px solid $mainFirstColor;
            width: 800px;
            height: 50vh;

            .cart-items-cont {
                max-height: 67%;
                overflow-y: auto;

                &::-webkit-scrollbar {
                    background-color: transparent;
                    width: 6px;
                    height: 8px;
                }

                    /* background of the scrollbar except button or resizer */
                    // &::-webkit-scrollbar-track {
                    // background-color:#2e2e2e81;
                    // }

                    /* scrollbar itself */
                &::-webkit-scrollbar-thumb {
                    background-color: $mainSecondColor;
                    border-radius: 16px;
                    visibility: hidden;
                }

                &:hover::-webkit-scrollbar-thumb {
                visibility:visible;
                }

                    /* set button(top and bottom of the scrollbar) */
                &::-webkit-scrollbar-button {
                    display:none;
                }
                .cart-items {
                    align-items: center;
                    
                    .col:first-child {
                        overflow: hidden;
                    }
                }
            }

            .cross {
                position: absolute; 
                top: 2px;
                right: 12px;
                cursor: pointer;
                font-size: 25px;

                &:hover {
                    color: red;
                }

            }

            .fake-input {
                display: inline-block;
                width: 40px;
                background-color: white;
                text-align: center;
                border: 0.5px solid lightgrey;
                border-radius: 5px;
            }

            .view-legenda > .col{
                font-size: 14px;
                color: gray;
            }

            .checkout {
                position: absolute;
                bottom: 15px;
                left: 30px;
                right: 30px;
                width: calc(100% - 60px);
                margin: 0 auto;
                background-color: white;

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
    }

    div {
        font-size: 20px;

        button {
            width: 25px;
        }
    }

    .ms-cart {
        background-color: $mainFirstColor;
        padding: 10px;
        padding-right: 30px;
        border-radius: 10px;
        position: relative;
        cursor: pointer;

        &::after {
            content: "\f07a";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            font-size: 30px;
            vertical-align: middle;
            position: absolute;
            z-index: 0;
            top: 3px;
            right: 12px;
        }

        .span-center-single, .span-center-double {
            position: relative;
            z-index: 1;
            color: white;
            top: -5px;
            font-size: 16px;
            font-weight: 900;
        }

        .span-center-single {
            right: -9px;
            padding-left: 10px;
        }

        .span-center-double {
            right: -13px;
        }
    }
}
</style>