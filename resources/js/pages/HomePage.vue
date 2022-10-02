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
   </div>
</template>

<script>
import Jumbotron from '../components/Jumbotron.vue'
import Categories from '../components/Categories.vue'

export default {
    name: 'HomePage',
    components: {
        Jumbotron,
        Categories,
    }
}
</script>

<style lang="scss">
@import '../common/commons.scss';
</style>