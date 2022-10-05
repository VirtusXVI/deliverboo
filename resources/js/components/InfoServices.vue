<template>
    <div class="info-services">
        <div class="container">
            <ul class="row row-cols-lg-3 row-cols-1">
                <li v-for="(item, index) in cardDetails" :key="index" class="col" :class="item.class">
                    <div class="card">
                        <div class="card-body">
                            <div class="thumb">
                                <img :src="item.thumb" :alt="item.alt">
                            </div>
                            <div class="text">
                                <div class="title">
                                    <h4>{{item.title}}</h4>
                                </div>
                                <div class="description mt-3">
                                    <p>{{item.description}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: 'InfoServices',
    data() {
        return {
            cardDetails: [
                {
                    'thumb': require('../assets/online-order.png'),
                    'alt': 'Icona ordine del cio dal telefono',
                    'title': 'Ordina facilmente',
                    'description': 'Ordina con un solo CLICK i tuoi piatti preferiti dal tuo telefono ovunque tu sia senza preoccupazioni!',
                },
                {
                    'thumb': require('../assets/food-delivery.png'),
                    'alt': 'Icona in viaggio per la consegn del cibo ordinato',
                    'title': 'Consegne facili e veloci',
                    'description': 'Potrai tenere traccia del tuo driver in qualunque momento direttamente dall\'applicazione.'
                },
                {
                    'thumb': require('../assets/courier.png'),
                    'alt': 'Icona consegna del cio dal telefono',
                    'title': 'Devi solo goderti il cibo',
                    'description': 'Riceverai il tuo ordine comodamente a casa, in ufficcio o qualunque sia la tua posizione. Ora non ti resta che gustarti il cibo!',
                }
            ]
        }
    }
}
</script>

<style lang="scss" scoped>
@import '../common/commons.scss';
@import '../common/variables.scss';
.info-services {
    margin: 50px 0;
    .container {
        margin: 0 auto;
    
        li {
            padding: 20px;
            
            .card {
                min-height: 400px;
                .card-body {
                    padding: 0;

                    .thumb {
                        padding: 30px;

                        img{
                            display: block;
                            width: 75%;
                            margin: 0 auto;
                        }
                    }

                    .text {
                        padding: 0px 20px 20px 20px;

                        .title, .description {
                            text-align: center;
                        }
                    }
                }
            }
        }
    }
}

@media screen and (max-width: 1000px) {
    .info-services .container {
        padding-inline: 150px;
    }
}

@media screen and (max-width: 770px) {
    .info-services .container {
        padding-inline: 75px;
    }
}
</style>