<template>
    <main class="restaurant-menu">
        <div v-if="dishDetails" class="jumbotron">
            immagine ristorante
        </div>
        <div class="menu-content flex container">
            <div class="menu-general">
                <div class="title">
                    <h2>{{dishDetails.name}}</h2>
                </div>
                <div class="image">
                    <img v-if="dishDetails.dish_image" :src="dishDetails.dish_image" :alt="dishDetails.name">
                    <img v-else src="https://img.freepik.com/premium-photo/chef-uniform-with-white-empty-plate-welcome-present-dish-restaurant-promotion_71163-674.jpg" alt="Piatto vuoto">
                </div>
                <div class="description">
                   {{dishDetails.description}}
                </div>
            </div>
            <div class="menu-details">
                <div class="price-menu">
                    <h5>Prezzo:</h5>
                    <span>
                        {{dishDetails.price}} &euro;
                    </span>
                </div>
                <div class="ingredients">
                    <h5>Ingredienti:</h5>
                    <span>
                        {{dishDetails.ingredients}} 
                    </span>
                </div>                
            </div>
        </div>
    </main>
</template>
<script>
    export default {
        name: 'MenuDetails',
        data() {
            return {
                dishDetails: []
            }
        },
        methods: {
            getDishDdetails() {
                 axios.get('/api/dettagli-piatti/' + this.$route.params.slug)
                .then((response) => {
                    this.dishDetails = response.data.results;
                })
            }
        },
        mounted() {
            this.getDishDdetails();
        }
    }
</script>
<style lang="scss">
    img {
        width: 300px;
    }
</style>