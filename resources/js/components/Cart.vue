<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link ms-cart mb-3" href="">
            Il mio Carrello<span class="d-inline-block" :class="{'span-center-single' : $store.state.cartCount < 10, 'span-center-double' : $store.state.cartCount >= 10}">{{ $store.state.cartCount }}</span>
        </a>

        <div v-if="$store.state.cart.length > 0" class="navbar-dropdown is-boxed is-right">
            <a  v-for="menu in $store.state.cart" :key="menu.id" class="navbar-item d-block d-flex align-items-center" href="">
                {{ menu.name }} 
                <button type="button" class="btn btn-success btn-number"  data-type="plus"
                    title="Remove from cart"
                    @click.prevent="increaseQuantityFromCart(menu)"><i class="fa-solid fa-plus"></i>
                </button>
                <span class="fake-input">{{menu.quantity}}</span>
                <button type="button" class="btn btn-danger btn-number mr-4" data-type="minus"
                    title="Remove from cart"
                    @click.prevent="decreaseQuantityFromCart(menu)"><i class="fa-solid fa-minus"></i>
                </button>
                
                Prezzo: &euro;{{ menu.totalPrice }}
                
                <span class="removeBtn ml-3"
                    title="Remove from cart"
                    @click.prevent="removeFromCart(menu)">
                </span>
                
            </a>

            <a class="navbar-item" href="">
                Totale: &euro;{{ totalPrice }}
            </a>

            <hr class="navbar-divider">

            <a class="navbar-item" href="">
                Checkout
            </a>
        </div>

        <div v-else class="navbar-dropdown is-boxed is-right">
            <a class="navbar-item" href="">
                Cart is empty
            </a>
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

    a {
        font-size: 20px;

        .fake-input {
            width: 50px;
            background-color: white;
            text-align: center;
            border: 0.5px solid lightgrey;
        }

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