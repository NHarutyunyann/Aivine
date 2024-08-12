 <template>

    <div class="liquid_product">
        <a href="/product-category/likvidacion-tesakani" class="liquid_product_title_box">
            <img src="/images/icons/liquid1.svg" alt="" class="title_box_img img-liquid" >
            <span> Լիկվիդացիոն տեսականի</span>
            <img src="/images/icons/arrow-right-1.svg" alt="" class="title_box_vector" >
        </a>
        <div class="liquid_product_images_box">
            <div @click="onClick(product)" class="liquid_image_box" v-for="product in products">
                <img :src="product?.main_image?.urls.small"  class="product_image">
                <p v-if="product.discount_price" class="last_price">{{ priceFormatter(product.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</p>
                <p class="new_price">{{ priceFormatter(product.discount_price || product.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</p>
            </div>
        </div>
    </div>
</template>



<script>
import ProductItem from "./ProductItem";
import {mapActions} from "vuex";
export default {
    components: {ProductItem},
    data() {
        return {
            products: []
        }
    },
    mounted() {
        this.getProducts()
    },
    methods: {
        async getProducts() {
            const {data} = await axios.get(`/get-products-by-type/liquidation-box`)
            this.products = data.items
        },
        onClick(product) {
            location.href = product.publish_url;
        }
    }
}
</script>
