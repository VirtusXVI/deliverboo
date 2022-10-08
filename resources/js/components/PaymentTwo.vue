<template>
    <div>
        <div class="pop-up-background" v-if="paymentSuccess">
            <div class="pop-up">
                <div>
                    Pagamento confermato,grazie per il tuo acquisto!
                </div>

                <div>
                    <a href="/" class="btn btn-outline-info">Chiudi</a>
                </div>
            </div>
        </div>
        <form @submit.prevent="submitPayment()" class="form-checkout">
            <div id="dropin-container"></div>
            <button id="submit-button" type="submit" class="button button--small" :disabled="paymentSuccess">Paga</button>
        </form>
    </div>
</template>

<script>

export default {
    name: 'PaymentTwo',
    data() {
        return {
            totalPrice: JSON.parse(localStorage.getItem('total')),
            // totalPrice: 'ciao',
            userToken: '',
            paymentSuccess: false,
        }
    },
    methods: {
        submitPayment() {
            axios.post('/api/controll/payment', {
                token: this.userToken,
                product: this.totalPrice
            })
        .then((response) => {
            // this.userToken = response.data.token;
            this.paymentSuccess = response.data.success
            let actualCart = JSON.parse(localStorage.getItem('cart'));
            let actualCartCount = JSON.parse(localStorage.getItem('cartCount'));
            let actualTotal = JSON.parse(localStorage.getItem('total'));
            actualTotal = 0;
            actualCart = [];
            actualCart = JSON.stringify(actualCart);
            actualTotal = JSON.stringify(actualTotal);
            actualCartCount = 0;
            localStorage.setItem('cartCount', actualCartCount);
            localStorage.setItem('cart', actualCart);
            localStorage.setItem('total', actualTotal);
            });
        }
    },

    mounted() {
        braintree.dropin.create({
        authorization: 'sandbox_hckbgctk_gwbpbfkzyj963v7f',
        selector: '#dropin-container'
        });

        axios.get('/api/orders/generate')
        .then((response) => {
            this.userToken = response.data.token;

            // console.log(this.userToken, 'ciao');
        });
    }
}


</script>

<style lang="scss">
@import '../common/commons.scss';
@import '../common/variables.scss';
.form-checkout {
    .button {
    cursor: pointer;
    font-weight: 500;
    line-height: inherit;
    position: relative;
    text-decoration: none;
    text-align: center;
    border-style: solid;
    border-width: 1px;
    border-radius: 3px;
    -webkit-appearance: none;
    -moz-appearance: none;
    display: inline-block;
    }

    .button--small {
    padding: 10px 20px;
    font-size: 0.875rem;
    }

    .button--green {
    outline: none;
    background-color: #64d18a;
    border-color: #64d18a;
    color: white;
    transition: all 200ms ease;
    }

    .button--green:hover {
    background-color: #8bdda8;
    color: white;
    }
}
.pop-up-background{
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
</style>