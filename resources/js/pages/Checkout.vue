<template>
    <div class="checkout-payment flex">
        <PaymentTwo />
    </div>
</template>

<script>
import PaymentTwo from '../components/PaymentTwo.vue'
export default {
    name: 'Checkout',
    components: {
        PaymentTwo
    }
}
</script>

<style lang="scss">
.checkout-payment {
    height: 100vh;
    // width: 100%;
    align-items: center;
    justify-content: center;
}
</style>