<template>
    <div class="dropdown cart-dropdown card-dropdown-desk cart-dropdown-box">
        <a href="/cart" class="dropdown-toggle header-icon-link header-icon">
             <span class="dropdown-icon-box">
                <img src="/images/icons/header-cart-icon.svg" alt="" class="dropdown-icon">
                <span class="cart-count badge-circle">{{ $store.getters.cartTotalCount }}</span>
            </span>
            <span class="icon-text">Զամբյուղ</span>
        </a>
        <div class="dropdown-menu">
            <div class="dropdownmenu-wrapper" v-if="$store.getters.cartItems.length">
                <div class="woodmart-scroll">
                <div class="dropdown-cart-products">
                    <div v-for="item in $store.getters.cartItems" class="product">
                        <figure class="product-image-container">
                            <a :href="item.url" class="product-image">
                                <img loading="lazy" :src="item.image" alt="product" style="object-fit: initial" width="80" height="80">
                            </a>
                        </figure>
                        <div class="product-details">
                            <h4 class="product-title">
                                <a :href="item.url">{{ item.title }}</a>
                            </h4>
                            <span class="cart-product-info">
							    <span class="cart-product-qty">{{ item.quantity }} x </span>
                                <span v-if="item.discount_price" class="old-price">{{ priceFormatter(item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
							    {{ priceFormatter(item.discount_price || item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}
							</span>
                        </div><!-- End .product-details -->
                        <a @click="removeFromCart(item.id)" style="cursor: pointer" class="btn-remove icon-cancel" title="Remove Product"></a>
                    </div><!-- End .product -->
                </div><!-- End .cart-product -->
            </div>
                <div class="dropdown-cart-total">
                    <span>Զեղչված արժեքը։</span>
                    <span class="cart-total-price float-right">{{ priceFormatter($store.getters.cartDiscountedTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</span>
                </div><!-- End .dropdown-cart-total -->

                <div class="dropdown-cart-action">
                    <a class="checkout-btn" href="/cart">Զամբյուղ</a>
                    <a class="form-btn" href="/checkout">Ձևակերպել</a>
                </div><!-- End .dropdown-cart-total -->
            </div><!-- End .dropdownmenu-wrapper -->

            <div class="dropdownmenu-wrapper cart-dropdown" v-if="!$store.getters.cartItems.length">
                <span>Զամբյուղում ապրանքներ չկան։</span>
            </div><!-- End .dropdownmenu-wrapper -->
        </div><!-- End .dropdown-menu -->
    </div><!-- End .dropdown -->
</template>

<script>
import {mapActions} from "vuex"

export default {
    methods: {
        ...mapActions(["removeFromCart"]),
    },
}
</script>
