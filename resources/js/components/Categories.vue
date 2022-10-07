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
                            <button class="overlay" @click="toggle(categoryId, category.id), toggle(isActive, index)" type="submit">{{category.name}}</button>
                            <img :src="categories_images[index]" :alt="category.name">
                        </div>
                    </div>
                </li>
            </ul>
            <div class="container d-flex justify-content-center align-items-center mt-5">
                <a href="#categories" class="btn btn-filter">Ristoranti</a>
            </div>
        </form>

        <div class="container-fluid mt-5">
            <div class="row row-cols-2 row-cols-lg-4">
                <div v-for="restaurant,index in super_restaurants" :key="index" class="col mb-4">
                    <router-link :to="{name: 'menu', params: {slug: restaurant.slug}}" class="card restaurant-card py-3">
                        <div class="card-img-top">
                            <img v-if="restaurant.restaurant_image" :src="'storage/' + restaurant.restaurant_image" :alt="restaurant.restaurant_name">
                            <img v-else src="https://images.unsplash.com/opengraph/1x1.png?auto=format&fit=crop&w=1200&h=630&q=60&mark-w=64&mark-align=top%2Cleft&mark-pad=50&blend-w=1&mark=https%3A%2F%2Fimages.unsplash.com%2Fopengraph%2Flogo.png&blend=https%3A%2F%2Fimages.unsplash.com%2Fphoto-1555396273-367ea4eb4db5%3Fcrop%3Dfaces%252Cedges%26cs%3Dtinysrgb%26fit%3Dcrop%26fm%3Djpg%26ixid%3DMnwxMjA3fDB8MXxzZWFyY2h8NHx8cmVzdGF1cmFudHxlbnwwfHx8fDE2NjUwNTkzNzc%26ixlib%3Drb-1.2.1%26q%3D60%26w%3D1200%26auto%3Dformat%26h%3D630%26mark-w%3D750%26mark-align%3Dmiddle%252Ccenter%26blend-mode%3Dnormal%26blend-alpha%3D10%26mark%3Dhttps%253A%252F%252Fimages.unsplash.com%252Fopengraph%252Fsearch-input.png%253Fauto%253Dformat%2526fit%253Dcrop%2526w%253D750%2526h%253D84%2526q%253D60%2526txt-color%253D000000%2526txt-size%253D40%2526txt-align%253Dmiddle%25252Cleft%2526txt-pad%253D80%2526txt-width%253D660%2526txt-clip%253Dellipsis%2526txt%253Drestaurant%26blend%3D000000" alt="Default Image">
                        </div>
                        <div class="card-body">
                            <div class="card-title">
                                <h3>{{restaurant.restaurant_name}}</h3>
                            </div>
                            <div class="card-text">
                                <p>{{restaurant.address}}</p>
                            </div>
                        </div>  
                    </router-link>
                </div>
            </div>
        </div>
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
    padding-top: 90px;
    padding-bottom: 60px;
    position: relative;

    .title {
        text-align: center;
        position: absolute;
        top: -18px;
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
                    line-height: 100%;
                }

                button {
                    color: white;
                    text-align: center;
                    line-height: 150px;
                    font-size: 35px;
                    border: 0;
                }
            }
        }
    }

    .btn-filter {
        background-color: $mainSecondColor;
        color: $mainFirstColor;
        padding: 10px 50px;
        border-radius: 16px;
        font-weight: 600;
        font-size: 20px;
        position: relative;

        &:after, &:before {
            content: "\2B07";
            font-size: 25px;
            display: inline-block;
            position: absolute;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        &:after {
            right: 5px;
        }

        &:before {
            left: 20px;
        }
        
        & {
            &:after, &:before {
                animation: 1s infinite;
                animation-name: go_down;
            }
        }
    }

    .btn-menu {
        background-color: $mainFirstColor;
        color: white;
        border-radius: 16px;
        font-weight: 600;
        font-size: 13px;
        margin: 1rem;
    }

    .is-active {
        box-shadow: 0px 0px 10px;
        border: 3px solid $mainFirstColor;
        background-color: $mainFirstColor;
    }

    .restaurant-card {
        position: relative;
        color: white;
        border: 0;
        min-height: 200px;

        .card-img-top {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: black;
            border-radius: 10px;

            img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
                opacity: 0.5;
                border-radius: 10px;
            }
        }

        .card-body {
            padding: 20px;
            text-align: center;
            z-index:1;
        }

        .card-router {
            position: relative;
            z-index: 1;
            text-align: center;
        }
    }
    @keyframes go_down {
        0% {
            top: 50%;
            opacity: 1;
        }
        100% {
            top: 85%;
            opacity: 0;
        }
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

    .categories-section .categories-content li .card {
        height: 100px;
    }

    .categories-section .categories-content li {
        padding: 0;
    }

    .categories-section .categories-content li .card .card-body .overlay {
        font-size: 22px;
    }
}
@media screen and (max-width: 768px) {

    .categories-section .categories-content li .card {
        height: 80px;
    }

    .categories-section .categories-content li .card .card-body .overlay {
        font-size: 16px;
    }
}
</style>