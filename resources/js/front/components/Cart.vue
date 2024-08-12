<template>
    <!-- <div>
        <div class="sidebar-wrapper" v-if="$store.getters.cartItems.length">
            <h3>Զամբյուղ</h3>
           <div class="scroll-box">
               <div class="position-relative" v-for="item in $store.getters.cartItems">
                   <a :href="item.url" class="product-box">
                       <img loading="lazy" :src="item.image" alt="product" style="object-fit: initial" width="80" height="80">
                       <div class="product-title-price">
                           <h4>{{ item.title }}</h4>
                           <label>
                               {{ item.quantity }} ×
                               <span v-if="item.discount_price" class="old-price">{{ priceFormatter(item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
                               <span> {{ priceFormatter(item.discount_price || item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
                           </label>
                       </div>
                   </a>
                   <i class="fa fa-plus remove-icon" @click="removeFromCart(item.id)"></i>
               </div>
           </div>
            <div class="price-total-box">
                <h4>
                    Զեղչված արժեքը։ <span>{{ priceFormatter($store.getters.cartDiscountedTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</span>
                </h4>
                <a href="/cart" class="btn-cart">Զամբյուղ</a>
                <a href="/checkout" class="btn-checkout">Ձևակերպել</a>
            </div>
        </div>
        <div class="cart-dropdown empty-cart-box" v-if="!$store.getters.cartItems.length">
            <h3>Զամբյուղ</h3>
            <span>Զամբյուղում ապրանքներ չկան։</span>
            <a href="/shop/">Վերադառնալ գնումների</a>
        </div>
    </div> -->
</template>

<script>
import {mapActions} from "vuex"

export default {
    methods: {
        ...mapActions(["removeFromCart"]),
    },
}
</script>
