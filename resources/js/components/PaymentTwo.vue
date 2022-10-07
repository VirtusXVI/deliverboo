<template>
   
<div>
    

<form @submit.prevent="submitPayment()">
    <div id="dropin-container"></div>
    <button id="submit-button" type="submit"  class="button button--small button--green">Purchase</button>
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
            userToken: ''
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
            
            console.log(response, 'ciao');
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

        console.log(this.totalPrice, 'okay');
    }
}


</script>

<style lang="scss">
.button {
  cursor: pointer;
  font-weight: 500;
  left: 3px;
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
</style>