<template>
    <div class="categories flex">
        <div class="category-select">
            <Restaurants />
        </div>
    </div>
</template>

<script>
import Restaurants from '../components/Restaurants.vue'
export default {
    name: 'Categories',
    components: {
        Restaurants
    },
}
</script>

<style lang="scss">
.categories {
    margin-top: 60px;
    justify-content: center;
    min-height: 200px;
    align-items: center;
}
</style>