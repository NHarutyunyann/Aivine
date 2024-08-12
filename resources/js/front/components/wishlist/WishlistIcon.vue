<template>
    <div class="dropdown cart-dropdown cart-dropdown-box wishlist-dropdown">
        <a :href="$store.getters.auth  ? '/my-account/wishlist' : '/wishlist'"  class="header-icon header-icon-link">
             <span class="dropdown-icon-box">
                 <img src="/images/icons/heart-icon.svg" alt="" class="dropdown-icon">
                 <span class="cart-count badge-circle">{{ $store.getters.wishlistTotalCount }}</span>
             </span>
            <span class="icon-text">Նախընտրելիներ</span>
        </a>
    </div>
</template>

<script>
import {mapActions} from "vuex"

export default {
    methods: {
        ...mapActions(["loadWishlist"]),
    },
    mounted() {
        this.loadWishlist()
    }
}
</script>
