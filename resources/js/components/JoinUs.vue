<template>
    <div class="join-us-section">
        <div class="text">
            <div class="title">
                <h2>Hai un'attività, ma ancora non usufruisci di Deliveboo?</h2>
            </div>

            <div class="description">
                <span>Cosa stai aspettando?</span> <br>
                <span>Registrati subito alla nostra piattaforma!</span>
            </div>
        </div>

        <button type="submit">
            <a href="/register">REGISTRATI ORA</a>
        </button>
    </div>
</template>

<script>
export default {
    name: 'JoinUs'
}
</script>

<style lang="scss">
.join-us-section {
    background-image: url('../assets/Joinus.png');
    height: 400px;
    background-size: contain;
    background-repeat: no-repeat;
    position: relative;

    .text {
        padding: 30px;
        color: white;
        width: 55%;
        font-family: 'Open Sans', sans-serif;
        .title h2 {
            font-size: 35px;
            font-weight: 700;
        }
        .description {
            font-size: 22px;
            font-weight: 400; 
            padding: 25px 0;          
        }
    }

    button {
        font-size: 20px;
        font-weight: 600;
        border: transparent;
        color: white;
        background-color: #FCCF4D;
        padding: 15px 30px;
        border-radius: 40px;
        margin-left: 30px;
        transition: 0.3s;

        &:hover {
            color: #FCCF4D;
            background-color: #49BEB7;
            outline: 2px solid #FCCF4D;
            scale: 1.1;
        }
    }
}
</style>