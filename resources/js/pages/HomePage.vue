<template>
   <div>
    <!-- Jumbotron -->
        <section class="jumbotron-section">
            <Jumbotron />
        </section>

    <!-- Categories -->
        <section class="categories-section">
            <Categories />
        </section>

    <!-- Info Services -->
        <section>
            <InfoServices />
        </section>

    <!-- JoinUs -->
        <section>
            <JoinUs />
        </section>
   </div>
</template>

<script>
import Jumbotron from '../components/Jumbotron.vue'
import Categories from '../components/Categories.vue'
import InfoServices from '../components/InfoServices.vue'
import JoinUs from '../components/JoinUs.vue'

export default {
    name: 'HomePage',
    components: {
        Jumbotron,
        Categories,
        InfoServices,
        JoinUs,
    },

    data() {
        return {
            categories: [],
        }
    },

    methods: {
        getCategoriesFromApi(){
            axios.get('http://127.0.0.1:8000/api/categorie')
            .then((response) => {
            this.restaurants = response.data.results;
            });
        }
    },

    mounted() {
        this.getCategoriesFromApi()
    }
}
</script>

<style lang="scss">
@import '../common/commons.scss';
@import '../common/variables.scss';
</style>