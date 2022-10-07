<template>
    <div class="jumbotron-height">
        <div class="jumbotron-content flex">
            <div class="overlay"></div>
            <div class="jumbotron-text container">
                <h1>Benvenuto su Deliveboo</h1>
                <p>Inizia subito a cercare il tuo ristornte preferito!</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Jumbotron'
}
</script>

<style lang="scss">
@import '../common/commons.scss';
@import '../common/variables.scss';
.jumbotron-height {
    height: 500px;
}
.jumbotron-content {
    background-image: url('https://images.unsplash.com/photo-1513104890138-7c749659a591?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1470&q=80');
    height: 500px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    justify-content: center;
    align-items: center;

    .overlay{
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.2);
    }

    .jumbotron-text {
        z-index: 10;
        color: white;
        text-align: center;
        animation: jumbotronScaleText 1.8s;

        h1 {
            font-size: 60px;
        }
        p {
            font-size: 17px;
        }
    }

    @keyframes jumbotronScaleText {
        0% {
            scale: 0; 
            opacity: 0;
        }
        100% {
            scale: 1;
            opacity: 1;
        }
    }
}



@media screen and (max-width: 355px) {
    .jumbotron-content .jumbotron-text h1{
        font-size: 40px;
    }
}

</style>