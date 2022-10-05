<template>
    <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link" href="">
            Cart ({{ $store.state.cartCount }})
        </a>

        <div v-if="$store.state.cart.length > 0" class="navbar-dropdown is-boxed is-right">
            <a  v-for="menu in $store.state.cart"
                :key="menu.id"
                class="navbar-item d-block"
                href=""
            >
                {{ menu.name }} x {{ menu.quantity }} - Prezzo: &euro;{{ menu.totalPrice }}
                <span class="removeBtn ml-3"
                    title="Remove from cart"
                    @click.prevent="removeFromCart(menu)">X
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
        }
    },

    computed: {
    totalPrice() {
        let total = 0;

        for (let menu of this.$store.state.cart) {
            total += menu.totalPrice;
        }
        
        return parseInt(total).toFixed(2);
    }
}
}
</script>

<style lang="scss" scoped>
.removeBtn {
    margin-right: 1rem;
    color: red;
}
</style>