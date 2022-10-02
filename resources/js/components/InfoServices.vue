<template>
    <div class="info-services">
        <div class="ms-small-container">
            <ul class="row info-services-card flex">
                 <li v-for="(item, index) in cardDetails" :key="index" class="col-md-4 mt-4" :class="item.class">
                    <div class="card">
                        <div class="card-body">
                            <div class="thumb flex">
                                <img :src="item.thumb" :alt="item.alt">
                            </div>
                            <div class="text flex">
                                <div class="title">
                                    <h4>{{item.title}}</h4>
                                </div>
                                <div class="description">
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
                    'class': 'down'
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
                    'class': 'down'
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

     .down{
        padding-top: 50px;
        display: flex;
    }

    .row .info-services-card .flex {
        justify-content: space-between;
    }

    li {
        padding: 20px;
        .card-body {
            padding: 0;

            .thumb {
                justify-content: center;
                padding: 30px;

                img{
                    width: 75%;
                }
            }

            .text {
                flex-direction: column;
                align-items: center;
                padding: 0px 20px 20px 20px;

                .title, .description {
                    text-align: center;
                }
            }
        }
    }
}

@media screen and (max-width: 575px) {
    .info-services .down{
        padding-top: 0;
        display: block;
    }
}
</style>