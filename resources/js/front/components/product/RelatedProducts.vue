<template>
    <div class="container">
        <h3 class="h3">Նմաանատիպ ապրանքներ</h3>
        <div class="row">
            <div class="col-md-3 col-sm-6" v-for="item in items" >
                <product-item :product="item" ></product-item>
                <!-- <category-item-box :product="item" v-for="item in items"></category-item-box> -->
            </div>
        </div>
    </div>
    <!-- <div class="products-slider-wrapper">
        <h3>Նմանատիպ ապրանքներ</h3>
        <div v-if="items && items.length" class="products-slider owl-carousel owl-theme dots-bottom">
            <product-item :product="item" v-for="item in items" :key="`slide_${item.id}`" />
        </div>
    </div> -->
</template>

<script>
import ProductItem from "./ProductItem";
export default {
    components: { ProductItem },
    props: ['product', 'itemsPerSlide'],
    data() {
        // console.log(this.items)

        return {
            items: [],
            carouselOptions: {
                loop: false,
                margin: 20,
                autoplay: false,
                dots: true,
                items: 2,
                responsive: {
                    576: {
                        items: 3
                    },
                    992: {
                        items: 4,
                    }
                }
            }
        }
    },
    beforeMount() {
        this.getRelatedProducts()
    },
    methods: {
        async getRelatedProducts() {
            const { data } = await axios.get(`/products/related/${this.product.id}`)
            this.items = (data && data.products) || [];
            this.$nextTick(function () {
                console.log('this.carouselOptions: ', this.carouselOptions)
                $('.products-slider').owlCarousel(this.carouselOptions)
            });
            console.log(this.items)
        },

    },

}
</script>

