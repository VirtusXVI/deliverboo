<template>
    <div class="join-us-section flex">
        <div class="text flex">
            <div class="title">
                <h2>Hai un'attività, ma ancora non usufruisci di Deliveboo?</h2>
            </div>

            <div class="description">
                <span>Cosa stai aspettando?</span> <br>
                <span>Registrati subito alla nostra piattaforma!</span>
            </div>

            <div class="button">
                <button type="submit">
                    <a href="/register">REGISTRATI ORA</a>
                </button>
            </div>
        </div>
        <div class="image flex">
            <img src="../assets/joinus-ppl.png" alt="">
        </div>
    </div>
</template>

<script>
export default {
    name: 'JoinUs'
}
</script>

<style lang="scss">
@import '../common/commons.scss';
@import '../common/variables.scss';
.join-us-section {
    margin: 50px 0;
    height: 400px;
    background: rgb(2,0,36);
    background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(73,190,183,1) 0%, rgba(255,255,255,1) 100%);
    position: relative;
    align-items: center;
    
    .image {
        width: 30%;
        height: 100%;
        align-items: flex-end;
        justify-content: flex-end;
            img {
                max-width: 505px;
            object-fit: contain;
            // position: absolute;
            bottom: 0;
        }
    }

    .text {
        width: 70%;
        padding: 30px;
        color: white;
        font-family: 'Open Sans', sans-serif;
        flex-direction: column;
        justify-content: center;
        .title h2 {
            font-size: 35px;
            font-weight: 700;
        }
        .description {
            font-size: 22px;
            font-weight: 400; 
            padding: 25px 0;          
        }

         button {
            font-size: 20px;
            font-weight: 600;
            border: transparent;
            color: white;
            background-color: $mainSecondColor;
            padding: 15px 30px;
            border-radius: 40px;
            transition: 0.3s;

            &:hover {
                color: $mainSecondColor;
                background-color: $mainFirstColor;
                outline: 2px solid $mainSecondColor;
                scale: 1.1;
            }

            a:hover {
                color: inherit;
            }
        }
    }

   
}

@media screen and (max-width: 1124px) {
    .join-us-section .image {
        width: 50%;
    }
    .join-us-section .text {
        width: 50%;
    }
}

@media screen and (max-width: 895px) {
    .join-us-section  {
        height: 100%;
        flex-direction: column;
        background: rgb(255,255,255);
        background: linear-gradient(0deg, rgba(255,255,255,1) 0%, rgba(73,190,183,1) 100%);
    }  

    .join-us-section .image {
        width: 100%;
        align-items: center;
        justify-content: center;
    }

    .join-us-section .text {
        width: 100%;
        text-align: center;
    }
}
</style>