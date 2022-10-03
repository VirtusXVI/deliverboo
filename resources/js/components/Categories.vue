<template>
    <div class="container cateogries-section" id="categories">
        <div class="title">
            <h2>
                <span>LE NOSTRE CATEGORIE</span>
            </h2>
        </div>
       <ul class="row categories-content">
            <li v-for="category, index in categories" :key="index" class="col-sm-4 mt-4">
                <div class="card">
                    <div class="card-body flex">
                        <a class="overlay" href="#categories">{{category.name}}</a>
                        <img src="../assets/slide-pizzeria-athena.jpg" alt="">
                    </div>
                </div>
            </li>
       </ul>
    </div>
</template>

<script>
export default {
    name: 'Categories',

    data() {
        return {
            categories: [],
        }
    },

    methods: {
        getCategoriesFromApi(){
            axios.get('http://127.0.0.1:8000/api/categorie')
            .then((response) => {
            this.categories = response.data.results;
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