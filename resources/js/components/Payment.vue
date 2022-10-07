<template>
    <div class="container">
       <div class="col-6 offset-3">
           <div class="card bg-light">
               <div class="card-header">Payment Information</div>
               <div class="card-body">
                <div class="alert alert-success" v-if="nonce">
                    Successfully generated nonce.
                </div>
                <div class="alert alert-danger" v-if="error">
                    {{ error }}
                </div>
                    <form>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <div class="input-group">
                                <div class="input-group-prepend"><span class="input-group-text">$</span></div>
                                <input type="number" id="amount" class="form-control" placeholder="Enter Amount">
                            </div>
                        </div>
                            <hr />
                        <div class="form-group">
                            <label>Credit Card Number</label>
                            <div id="creditCardNumber" class="form-control"></div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label>Expire Date</label>
                                    <div id="expireDate" class="form-control"></div>
                                </div>
                                <div class="col-6">
                                    <label>CVV</label>
                                    <div id="cvv" class="form-control"></div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-outline-info" @click.prevent="payWithCreditCard" >Invia</button>
                    </form>
               </div>
           </div>
       </div>
   </div>
</template>

<script>
import braintree from 'braintree-web';

export default {
    name: 'Payment',
    data() {
        return {
            hostedFieldInstance: false,
            nonce: '',
            error: '',
            userToken: ''
        }
    },
    methods: {
        payWithCreditCard() {
            if(this.hostedFieldInstance)
            {
                this.error = "";
                this.nonce = "";
                
                this.hostedFieldInstance.tokenize().then(payload => {
                    console.log(payload);
                    this.nonce = payload.nonce;
                    // console.log(this.nonce, 'ciao');
                })
                .catch(err => {
                    // console.error(err);
                    this.error = err.message;
                })
            }
        }
    },
    mounted() {
        axios.get('/api/orders/generate')
        .then((response) => {
            this.userToken = response.data.token;

            // console.log(this.userToken, 'ciao');
        });
        
       braintree.client.create({
           authorization: "sandbox_v2bk6764_gwbpbfkzyj963v7f"
       })
       .then(clientInstance => {
           let options = {
               client: clientInstance,
               styles: {
                   input: {
                       'font-size': '14px',
                       'font-family': 'Open Sans'
                   }
               },
               fields: {
                   number: {
                       selector: '#creditCardNumber',
                       placeholder: 'Enter Credit Card'
                   },
                   cvv: {
                       selector: '#cvv',
                       placeholder: 'Enter CVV'
                   },
                   expirationDate: {
                       selector: '#expireDate',
                       placeholder: '00 / 0000'
                   }
               }
           }
           return braintree.hostedFields.create(options)
       })
       .then(hostedFieldInstance => {
           this.hostedFieldInstance = hostedFieldInstance;
       })
       .catch(err => {
       });
   }
}
</script>
