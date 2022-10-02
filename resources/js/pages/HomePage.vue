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
        JoinUs
    }
}
</script>

<style lang="scss">
@import '../common/commons.scss';
@import '../common/variables.scss';
</style>