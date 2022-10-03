<template>
    <div class="container cateogries-section" id="categories">
        <div class="title">
            <h2>
                <span>LE NOSTRE CATEGORIE</span>
            </h2>
        </div>

        <form @submit.prevent="sendCategory()">
            <ul class="row categories-content">
                <li v-for="category, index in categories" :key="index" class="col-sm-4 mt-4">
                    <div class="card">
                        <div class="card-body flex">
                            <a type="submit" class="overlay" href="#categories" @click="getCategoryId(index + 1)">{{category.name}}</a>
                            <img :src="categories_images[index]" :alt="category.name">
                        </div>
                    </div>
                </li>
            </ul>
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
                'https://www.buttalapasta.it/wp-content/uploads/2017/11/pizza-margherita.jpg',
                'https://www.donnamoderna.com/content/uploads/2021/01/sushi-nigiri.jpg',
                'https://www.fattoincasadabenedetta.it/wp-content/uploads/2019/12/tagliatelle-al-rag%C3%B9-di-salsiccia.jpg',
                'https://athome.starbucks.com/sites/default/files/2021-08/LatteArtatHome_Header_0.jpg',
                'https://www.ricettedalmondo.it/images/foto-ricette/t/29620-torta-della-nonna.jpg',
                'https://vegnews.com/media/W1siZiIsIjI5NDQ2L1ZlZ05ld3MuVmVnYW5GYXN0Rm9vZC5Nb250eXNHb29kQnVyZ2VyLmpwZyJdLFsicCIsInRodW1iIiwiMTYwMHg5NDYjIix7ImZvcm1hdCI6ImpwZyJ9XSxbInAiLCJvcHRpbWl6ZSJdXQ/VegNews.VeganFastFood.MontysGoodBurger.jpg?sha=892e9c726614c0f8'
            ],
            categoryId: []
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
            console.log(this.categoryId)
        },
        sendCategory() {
            axios.post('/api/ristoranti')
            .then((response) => {
                this.categoryId = response;
                console.log(response);
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

.categories-section {
    margin: 50px 0;
    position: relative;

    .title {
        text-align: center;
        position: absolute;
        top: -70px;
        left: 0;
        right: 0;

        span {
            font-weight: 700;
            background-color: $mainSecondColor;
            padding: 15px 50px;
            border-radius: 20px;
            color: white;
        }

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
                display: inline-block;
                height: 100%;
                width: 100%;
                color: white;
                text-align: center;
                font-size: 35px;
                line-height: 150px;
            }
        }
    }
}



@media screen and (max-width: 991px) {
    .categories-content li .card-body a {
        font-size: 25px;
    }
}


@media screen and (max-width: 767px) {
    .categories-content li .card-body a {
        font-size: 20px;
    }
}

@media screen and (max-width: 575px) {
    .categories-content li .card-body a {
        font-size: 40px;
    }
}

@media screen and (max-width: 455px) {
    .categories-section .title span {
        font-size: 20px;
    }
}

@media screen and (max-width: 377px) {
    .categories-content li .card-body a {
        font-size: 30px;
    }

    .categories-section .title span {
        font-size: 15px;
        display: block;
        margin: 0 15px;
    }
}

@media screen and (max-width: 277px) {
    .categories-content li .card-body a {
        font-size: 25px;
    }
}
</style>