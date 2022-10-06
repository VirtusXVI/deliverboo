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
                <div  v-for="menu in $store.state.cart" :key="menu.id" class="navbar-item row row-cols-3 text-center pb-3" href="">
                    <div class="col">{{ menu.name }}</div> 
                    <div class="col">
                        <button type="button" class="btn btn-success btn-number"  data-type="plus" title="Remove from cart" @click.prevent="increaseQuantityFromCart(menu)">
                            <i class="fa-solid fa-plus"></i>
                        </button>
                        <div class="fake-input">{{menu.quantity}}</div>
                        <button type="button" class="btn btn-danger btn-number" data-type="minus" title="Remove from cart" @click.prevent="decreaseQuantityFromCart(menu)">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>
                    
                    <div class="col d-flex justify-content-between">
                        <div>Prezzo: &euro;{{ menu.totalPrice }}</div>
                        <button type="button" class="btn" title="Remove from cart" @click.prevent="removeFromCart(menu)">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
                
                <div v-if="$store.state.cart.length > 0" class="navbar-dropdown is-boxed is-right">
                    <div class="navbar-item" href="">Totale: &euro;{{ totalPrice }}</div>

                    <hr class="navbar-divider">

                    <a class="navbar-item" href="">
                        Checkout
                    </a>
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
        background-color: transparent;
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