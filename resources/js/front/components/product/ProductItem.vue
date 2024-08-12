<template>
    <div class="product-grid3">
        <div class="product-image3">
            <a :href="'/product/' + product.slug">
                <img class="pic-1" :src="product?.main_image?.urls.original" />
                <img class="pic-2" :src="product?.attachments[0]?.urls.original">
            </a>
            <ul class="social">
                <li>
                    <add-to-cart-btn :prop-product='product'></add-to-cart-btn>
                </li>
            </ul>
            <!-- <span class="product-new-label">Նորույթ</span> -->
            <div v-if=product.position>
                <span  class="product-new-label">{{ product.position }}</span>
            </div>
        </div>
        <div class="product-content">
            <h3 class="title">{{ product.title }} </h3>
            <!-- <p>{{ product.sale_price }}</p> -->
            <item-price :product="product"></item-price>
            <!-- <ul class="rating " >
                <li>Չափսեր</li>
                <li v-for="size in this.product.sizes" style="width: 20px; height: 20px;" >{{ size.size }}</li>
            </ul> -->
        </div>
    </div>
</template>
<script>

import VClamp from 'vue-clamp';

export default {
    props: ['product'],
    components: {
        'v-clamp': VClamp,
    },
    methods: {
        openFastView(product) {
            this.$store.commit('OPEN_PRODUCT_ZOOM', product);
        }
    },

    isPrime( num ) {
        for( let i = 2; i < num; i++ ) {
            if( num % i === 0 ) {
                return false;
            }
        }
        return num > 1
    }
}
</script>


<style scoped>
.social {
    width: 100%;
}
.rating{
    width: 70%;
    position: absolute;
    right: 0;
}

</style>