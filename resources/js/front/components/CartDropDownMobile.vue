<template>
    <div class="dropdown cart-dropdown cart-dropdown-mobile cart-dropdown-box" :class="{'show': cartOpened}">
        <div @click="closeCart" class="body-overlay"></div>
        <button @click="openCart" class="dropdown-toggle header-icon header-icon-link">
             <span class="dropdown-icon-box">
                <img src="/images/icons/header-cart-icon.svg" alt="" class="dropdown-icon">
                <span class="cart-count badge-circle">{{ $store.getters.cartTotalCount }}</span>
            </span>
            <span class="icon-text">Զամբյուղ</span>
        </button>

        <div class="dropdown-menu">
            <div class="dropdownmenu-wrapper">
                <div class="woodmart-scroll">
                    <div class="dropdown-cart-products">
                        <div class="dropdown-header-mobile">
                            <h3>ԶԱՄԲՅՈՒՂ</h3>
                            <p @click="closeCart" >ՓԱԿԵԼ <i class="fas fa-times" style="font-size:19px"></i> </p>
                        </div>
                        <div v-if="!$store.getters.cartItems.length" class="message"><span>Զամբյուղում ապրանքներ չկան։</span></div>
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
                <div class="dropdown-cart-total" v-if="$store.getters.cartItems.length">
                    <span>Զեղչված արժեքը։</span>
                    <span class="cart-total-price float-right">{{ priceFormatter($store.getters.cartDiscountedTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</span>
                </div><!-- End .dropdown-cart-total -->

                <div class="dropdown-cart-action">
                    <a class="checkout-btn" href="/cart">Զամբյուղ</a>
                    <a v-if="$store.getters.cartItems.length" class="form-btn" href="/checkout">Ձևակերպել</a>
                </div><!-- End .dropdown-cart-total -->
            </div><!-- End .dropdownmenu-wrapper -->
            <!-- End .dropdownmenu-wrapper -->
        </div><!-- End .dropdown-menu -->
    </div><!-- End .dropdown -->
</template>

<script>
import {mapActions} from "vuex"

export default {
    methods: {
        ...mapActions(["removeFromCart"]),
        openCart() {
            this.cartOpened = true;
        },
        closeCart() {
            this.cartOpened = false;
        },
    },
    updated() {
        $('body').toggleClass('scrollHide', this.cartOpened)
    },
    data() {
        return {
            cartOpened: false,
        }
    }
}
</script>
