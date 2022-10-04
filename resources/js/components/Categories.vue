<template>
    <div class="container-fluid categories-section" id="categories">
        <div class="title">
            <h2>
                <span>LE NOSTRE CATEGORIE</span>
            </h2>
        </div>

        <form @submit.prevent="sendCategory()">
            <ul class="row row-cols-6 categories-content">
                <li v-for="category, index in categories" :key="index" class="col">
                    <div class="card">
                        <div class="card-body flex">
                            <a class="overlay" href="#categories" @click="getCategoryId(category.id)">{{category.name}}</a>
                            <img :src="categories_images[index]" :alt="category.name">
                        </div>
                    </div>
                </li>
            </ul>
            <div class="container d-flex justify-content-center align-items-center mt-5">
                <button type="submit" class="btn">Filtra</button>
            </div>
        </form>
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
            // isActive: false,
        }
    },

    methods: {
        getCategoriesFromApi(){
            axios.get('http://127.0.0.1:8000/api/categorie')
            .then((response) => {
            this.categories = response.data.results;
            });
        },
        getCategoryId(id) {
            if(this.categoryId.includes(id)) {
                let index = this.categoryId.indexOf(id);
                if (index !== -1) {
                    this.categoryId.splice(index, 1);
                }
            } else {
                this.categoryId.push(id);
            }
        },
        sendCategory() {
            axios.post('http://127.0.0.1:8000/api/ristoranti', {
                id: this.categoryId
            })
            .then(function (response) {
                let specificity = response.data.results.length;
                let filtered_restaurants = response.data.results;
                let all_restaurants = [];
                let super_restaurants = [];
                let pushable = true;
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
                            if(!super_restaurants.includes(all_restaurants[i])){
                                super_restaurants.push(all_restaurants[i]);
                            }
                        }
                        // se è uguale si fa uno splice e si rimuove l'elemento utilizzando l'index del secondo ciclo
                        console.log(super_restaurants);
                    }
                    // ciclo sull'array super restaurants
                    // for(let i = 0; i < super_restaurants.length; i++){
                    //     let sameElement = 0;
                    //     // secondo ciclo sull'array restaurants
                    //     for(let j = 0; j < super_restaurants.length; j++){
                    //         // controllo che l'id dell' elemento del secondo ciclo sia diverso dall'id dell'elemento del primo ciclo

                    //         if(sameElement < 1){
                    //             sameElement++;
                    //         }else{

                    //         }
                    //     }
                    // }
                }
                else{
                    super_restaurants = all_restaurants;
                }
                console.log(super_restaurants);
            })
            .catch(function (error) {
                console.log(error);
            });
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

    // .is-active {
    //     box-shadow: 0px 0px 5px;
    // }
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