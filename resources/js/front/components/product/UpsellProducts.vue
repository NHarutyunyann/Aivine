<template>
    <div class="product-slider">
        <h3 v-if="items.length">ՆԱԵՎ ԿԱՐՈՂ Է ՀԵՏԱՔՐՔՐԵԼ</h3>
        <div id="carouselExampleIndicators" v-if="items.length" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" v-for="(chunk, key) in itemsChunk" :data-slide-to="key" :class="{active: key === 0}"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item" v-for="(chunk, key) in itemsChunk" :class="{active: key === 0}">
                    <div class="d-flex carousel-item-step">
                        <div class="carousel-item-step-box" v-for="item in chunk">
                            <product-item :product="item" />
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true">
                                            <i class='fas fa-chevron-left left-right-arrow-icon'></i>
                                        </span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true">
                                            <i class='fas fa-chevron-right left-right-arrow-icon'></i>
                                        </span>
            </a>
        </div>
    </div>
</template>

<script>
import ProductItem from "./ProductItem";
export default {
    components: {ProductItem},
    props: ['product', 'itemsPerSlide'],
    data() {
        return {
            items: this.product.upsell_products || [],
            itemsChunk: this.sliceIntoChunks(this.product.upsell_products || [], this.itemsPerSlide || 4),
        }
    },
    methods: {
        sliceIntoChunks(arr, chunkSize) {
            const res = [];
            for (let i = 0; i < arr.length; i += chunkSize) {
                const chunk = arr.slice(i, i + chunkSize);
                res.push(chunk);
            }
            return res;
        }
    }
}
</script>

