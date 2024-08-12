<template>
    <a href="javascript:" class="wishlist-btn" :class="{ active: isSelected }" @click="handleClick">
        <!-- <i class="fa fa-shopping-cart"></i> -->
        <!-- <i class="far fa-heart"></i> -->
        <i class="fa-solid fa-magnifying-glass"></i>
        <!-- <span>Նախընտրելիներ</span> -->
    </a>
   
</template>

<script>
import { mapActions } from 'vuex'

export default {
    props: ['propProduct'],
    data() {
        return {

        }
    },
    methods: {
        ...mapActions(['addToWishlist', 'removeFromWishlist']),
        handleClick() {
            if (this.isSelected) {
                this.removeFromWishlist(this.propProduct);
            } else {
                this.addToWishlist(this.propProduct);
            }
        }
    },
    computed: {
        isSelected() {
            return this.$store.getters.wishlistItems.find(i => i.id === this.propProduct.id)
        }
    }
}
</script>
