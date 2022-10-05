<template>
    <section>

        <div class="container">
            <div v-for="restaurant, index in restaurants" :key="index">
                <div class="card">
                    <h4>{{restaurant.restaurant_name}}</h4>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    name: 'Restaurants',

    data() {
        return {
            restaurants: [],
        }
    },

    methods: {
        getRestaurantsFromApi(){
            axios.get('http://127.0.0.1:8000/api/ristoranti')
            .then((response) => {
            this.restaurants = response.data.results;
            });
        }
    },

    mounted() {
        this.getRestaurantsFromApi()
    }
}
</script>