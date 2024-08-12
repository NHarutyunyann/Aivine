<template>
    <div class="wishlist">
        <div class="product-content">
            <div class="product-card" v-for="product in $store.getters.wishlistItems" >
                <a class="remove-product" @click.stop.prevent="removeFromWishlist(product.id)">ՀԵՌԱՑՆԵԼ <i class="fas fa-times"></i></a>
                <div class="product-box d-flex flex-column">
                    <a :href="product.publish_url">
                <span class="img-wrap">
                    <img loading="lazy" :src="product?.main_image?.urls.medium" />
                </span>
<!--                        <v-clamp ellipsis="..." location="end" tag="h4" autoresize :max-lines="2">{{ product.title }}</v-clamp>-->
                            <h4>{{ product.title }}</h4>
                    </a>

                    <item-price :product="product"></item-price>

                    <add-to-cart-btn :prop-product="product"></add-to-cart-btn>
<!--                    <span v-if="product.stock_status !== 'out_of_stock' && product.is_new" class="new product-label">Նորույթ</span>-->
                    <span v-if="product.stock_status === 'out_of_stock'" class="new product-label" style="color: black;background-color: #fff"> Առկա չէ </span>
                    <div class="product-icon-box">
                        <add-to-compare-btn :product="product"></add-to-compare-btn>
                        <a href="javascript:" data-toggle="modal" data-target="#viewProductModal" @click="openFastView(product)" class="search-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 32 32"><path  d="m29 27.586l-7.552-7.552a11.018 11.018 0 1 0-1.414 1.414L27.586 29ZM4 13a9 9 0 1 1 9 9a9.01 9.01 0 0 1-9-9Z"/></svg>
                            <span>Արագ դիտում</span>
                        </a>
                        <add-to-wishlist-btn :prop-product="product"></add-to-wishlist-btn>
                    </div>
                </div>
            </div>

        </div>
        <!--        <div class="pagination-box">-->
        <!--            <a href="javascript:" class="active">1</a>-->
        <!--            <a href="javascript:">2</a>-->
        <!--            <a href="javascript:">3</a>-->
        <!--            <a href="javascript:"><i class="fa fa-angle-right"></i></a>-->
        <!--        </div>-->
    </div>
</template>
<script>
import {mapActions} from "vuex";
import VClamp from 'vue-clamp';

export default {
    components: {
        'v-clamp': VClamp,
    },
    methods: {
        ...mapActions(['removeFromWishlist']),
    }
}
</script>
