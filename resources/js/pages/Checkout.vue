<template>
    <div class="checkout-payment">
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
    width: 480px;
    margin: 30px auto;
}
</style>