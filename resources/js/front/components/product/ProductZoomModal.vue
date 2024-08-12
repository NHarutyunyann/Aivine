<template>
    <div class="modal fade view-product-modal" id="viewProductModal" tabindex="-1" role="dialog" aria-labelledby="viewProductModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" v-if="product">
            <div class="modal-content">
                <div class="modal-header">
                    <a href="javascript:" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div v-if="product" class="modal-body">
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="product-item">
                                <img loading="lazy" :src="product.main_image?.urls?.large" />
                            </div>
                        </div>

                        <div class="col-12 col-md-6 product-single-details">
                            <h3>{{ product.title }}</h3>

                            <div v-if="product.excerpt" class="product-excerpt clearfix mb-2" v-html="product.excerpt"></div>

                            <span v-if="product.discount_price" class="old-price">{{ priceFormatter(product.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
                            <span class="product-price">{{ priceFormatter(product.discount_price || product.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>

                            <add-to-cart-btn v-if="product.stock_status !== 'out_of_stock'" :prop-product="product"/>

                            <p v-if="product.stock_status === 'out_of_stock'" style="color: #B50808;font-weight: 600;"> Առկա չէ </p>
                            <ul class="product-meta-share-box">
                                <li>
                                    <strong>Կոդ։ </strong>
                                    <span>{{ product.sku }}</span>
                                </li>
                                <li style="display:none;">
                                    <strong>Կիսվել։ </strong>
                                    <span>
                                            <a target="_blank" :href="`https://www.facebook.com/sharer/sharer.php?u=${product.publish_url}`">
                                                 <i class="fab fa-facebook-f"></i>
                                            </a>
                                            <a target="_blank" :href="`https://twitter.com/share?url=${product.publish_url}`">
                                                 <i class="fab fa-twitter"></i>
                                            </a>
                                            <a target="_blank" :href="`https://pinterest.com/pin/create/button/?url=${product.publish_url}`">
                                                 <i class="fab fa-pinterest-p"></i>
                                            </a>
                                            <a target="_blank" :href="`https://www.linkedin.com/shareArticle?mini=true&url=${product.publish_url}`">
                                                 <i class="fab fa-linkedin-in"></i>
                                            </a>
                                            <a target="_blank" :href="`https://telegram.me/share/url?url=${product.publish_url}`">
                                                 <i class="fab fa-telegram-plane"></i>
                                            </a>
                                        </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
export default {
    computed: {
        product() {
            return this.$store.state.app.zoomProduct
        }
    }
}
</script>
