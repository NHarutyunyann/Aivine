<template>
    <div class="product-content">
        <div id="accordion" class="container">
            <div class="product-tab-title-box">
                <h2>Տեսականի</h2>
                <button class="btn btn-link" :class="{collapsed: type !== 'new'}" @click="type = 'new'; getProducts()">
                    Նորույթներ
                </button>
                <button class="btn btn-link" :class="{collapsed: type !== 'door_accessories'}" @click="type = 'door_accessories'; getProducts()">
                    Դռան պարագաներ
                </button>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="tab-content">
                    <product-item v-for="product in products" :key="`${type}_${product.id}`" :product="product" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import ProductItem from "./product/ProductItem";
export default {
    components: {ProductItem},
    data() {
        return {
            type: 'new',
            products: []
        }
    },
    mounted() {
        this.getProducts()
    },
    methods: {
        async getProducts() {
            const {data} = await axios.get(`/get-products-by-type/${this.type}`)
            this.products = data.items
        }
    }
}
</script>
