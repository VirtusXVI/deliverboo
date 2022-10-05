<template>
    <div class="container-fluid categories-section" id="categories">
        <div class="title">
            <h2>
                <span>LE NOSTRE CATEGORIE</span>
            </h2>
        </div>

        <form @submit.prevent="sendCategory(), getFilteredRestaurants()">
            <ul class="row row-cols-6 categories-content">
                <li v-for="category, index in categories" :key="index" class="col">
                    <div class="card" :class="{'is-active' : isActive.includes(index)}">
                        <div class="card-body flex">
                            <a class="overlay" href="#categories" @click="toggle(categoryId, category.id), toggle(isActive, index)">{{category.name}}</a>
                            <img :src="categories_images[index]" :alt="category.name">
                        </div>
                    </div>
                </li>
            </ul>
            <div class="container d-flex justify-content-center align-items-center mt-5">
                <button type="submit" class="btn">Filtra</button>
            </div>
        </form>

        <section>
            <div v-for="restaurant,index in super_restaurants" :key="index">
                <div>
                    {{ restaurant.restaurant_name }}
                </div>
            </div>
        </section>
    </div>
</template>

<script>

export default {
    name: 'Categories',

    data() {
        return {
            categories: [],
            categories_images: [
                'https://www.giallozafferano.it/images/249-24919/Pizza-napoletana_450x300.jpg',
                'https://www.donnamoderna.com/content/uploads/2021/01/sushi-nigiri.jpg',
                'https://www.fattoincasadabenedetta.it/wp-content/uploads/2019/12/tagliatelle-al-rag%C3%B9-di-salsiccia.jpg',
                'https://athome.starbucks.com/sites/default/files/2021-08/LatteArtatHome_Header_0.jpg',
                'https://www.ricettedalmondo.it/images/foto-ricette/t/29620-torta-della-nonna.jpg',
                'https://vegnews.com/media/W1siZiIsIjI5NDQ2L1ZlZ05ld3MuVmVnYW5GYXN0Rm9vZC5Nb250eXNHb29kQnVyZ2VyLmpwZyJdLFsicCIsInRodW1iIiwiMTYwMHg5NDYjIix7ImZvcm1hdCI6ImpwZyJ9XSxbInAiLCJvcHRpbWl6ZSJdXQ/VegNews.VeganFastFood.MontysGoodBurger.jpg?sha=892e9c726614c0f8'
            ],
            categoryId: [],
            filtered_restaurants: [],
            isActive: [],
            super_restaurants:[],
        }
    },

    methods: {
        getCategoriesFromApi(){
            axios.get('http://127.0.0.1:8000/api/categorie')
            .then((response) => {
            this.categories = response.data.results;
            });
        },
        sendCategory() {
            axios.post('http://127.0.0.1:8000/api/ristoranti', {
                id: this.categoryId
            })
            .then(function (response) {
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        getFilteredRestaurants(){
            axios.get('http://127.0.0.1:8000/api/filteredrestaurants', { params: {id: this.categoryId} })
            .then((response) => {
                let specificity = response.data.results.length;
                let filtered_restaurants = response.data.results;
                let all_restaurants = [];
                let displayable_restaurants = [];
                filtered_restaurants.forEach(element => {
                    let restaurants = element.user;
                    restaurants.forEach(element => {
                        all_restaurants.push(element);
                    });
                });
                if(specificity > 1){
                    for(let i = 0; i < all_restaurants.length; i++){
                        let local_specificity = 0;
                        for(let j = 0; j < all_restaurants.length; j++){
                            if(all_restaurants[j].id === all_restaurants[i].id){
                                local_specificity++;
                            }
                        }
                        if(local_specificity === specificity){
                            if(!displayable_restaurants.includes(all_restaurants[i])){
                                let elementToPush = all_restaurants[i];
                                // dichiaro una variabile is_present inizializzata a false
                                let is_present = false;
                                // controllo che l'elemento che sto per pushare non abbia l'id di un elemento già presente all'interno dell'array
                                for(let j = 0; j < displayable_restaurants.length; j++){
                                    if(elementToPush.id === displayable_restaurants[j].id){
                                        is_present = true;
                                    }
                                }

                                // se l'elemento che sto per pushare non ha lo stesso id di un elemento che è già presente nell'array lo pusho
                                if(is_present === false){
                                    displayable_restaurants.push(elementToPush);
                                }
                            }
                        }
                    }
                }
                else{
                    displayable_restaurants = all_restaurants;
                }

                this.super_restaurants = displayable_restaurants;
            })
        },
        toggle(array, item) {
            if(array.includes(item)) {
                let index = array.indexOf(item);
                if (index !== -1) {
                    array.splice(index, 1);
                }
            } else {
                array.push(item);
            }
        }
    },

    mounted() {
        this.getCategoriesFromApi();
    }
}
</script>

<style lang="scss">
@import '../common/commons.scss';
@import '../common/variables.scss';

.categories-section {
    padding-block: 60px;
    position: relative;

    .title {
        text-align: center;
        position: absolute;
        top: -77px;
        left: 0;
        right: 0;

        span {
            font-weight: 700;
            background-color: $mainSecondColor;
            padding: 15px 50px;
            border-radius: 20px;
            color: white;
            border: 5px solid #f8fafc;
        }

    }
    .categories-content {

        li {
            .card {
                height: 150px;
                border-radius: 20px;
            }
            .card-body {
                justify-content: center;
                align-items: center;
                padding: 0;
                overflow: hidden;
                border-radius: 20px;
                position: relative;
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.17);

                img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                .overlay {
                    height: 100%;
                    width: 100%;
                    background-color: rgba(0, 0, 0, 0.5);
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                }

                a {
                    color: white;
                    text-align: center;
                    line-height: 150px;
                    font-size: 35px;
                }
            }
        }
    }

    .btn {
        background-color: $mainSecondColor;
        color: $mainFirstColor;
        padding: 10px 50px;
        border-radius: 16px;
        font-weight: 600;
        font-size: 20px;
    }

    .is-active {
        box-shadow: 0px 0px 10px;
        border: 3px solid $mainFirstColor;
        background-color: $mainFirstColor;
    }
}



@media screen and (max-width: 1200px) {
    .categories-section .categories-content li .card .card-body a {
        font-size: 25px;
        line-height: 120px;
    }

    .categories-section .categories-content li .card {
        height: 120px;
    }

    .categories-section .categories-content li {
        padding: 0 5px;
    }
}
@media screen and (max-width: 992px) {
    .categories-section .categories-content li .card .card-body a {
        font-size: 20px;
        line-height: 100px;
    }

    .categories-section .categories-content li .card {
        height: 100px;
    }

    .categories-section .categories-content li {
        padding: 0;
    }
}
@media screen and (max-width: 768px) {
    .categories-section .categories-content li .card .card-body a {
        font-size: 15px;
        line-height: 80px;
    }

    .categories-section .categories-content li .card {
        height: 80px;
    }
}
</style>