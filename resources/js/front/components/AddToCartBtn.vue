<template>
    <div>
        <div class="d-flex justify-content-center mt-2 add-to-cart-box" :class="{ outOfStock: propProduct.stock_status === 'out_of_stock' }">
            <li>
                <a :href="'/product/' + propProduct.slug">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
            </li>
            <a href="javascript:" @click="handleAddToCart" :class="{ 'added': isAddedToCart(propProduct.id), 'disabled': propProduct.stock_status === 'out_of_stock' }">
                <span v-if="propProduct.stock_status !== 'out_of_stock' && isAddedToCart(propProduct.id)" class="fa fa-shopping-bag"></span>
                <span v-if="propProduct.stock_status !== 'out_of_stock' && !isAddedToCart(propProduct.id)" class="fa fa-shopping-bag"></span>
                <span v-if="propProduct.stock_status === 'out_of_stock'" class="fa fa-shopping-bag"></span>
            </a>
        </div>
        <div>
            <ul v-if="this.propProduct.sizes.length > 0" class="btn-group sizes " style="padding-left: 0;">
                <li class="ad" v-for="size in this.propProduct.sizes" style="border: 1px solid rgba(0, 0, 0, 0.1); width: 40px; height: 40px; border-radius: 50%;">
                    <input @click="addSize(size.size)" type="radio" :value="size.size" class="btn-check ad" :id="size.size" name="size" style=" width: 100%; height: 100%;">
                    <label class="btn btn-default ad" :for="size.size">{{ size.size }}</label>
                </li>
            </ul>
        </div>
    </div>
</template>
<script>
import { mapActions } from 'vuex'

export default {
    props: ['propProduct'],
    data() {
        return {
            checkedSize: '',
            quantity: 1
        }
    },
    methods: {
        ...mapActions(["addToCart"]),
        addSize(size) {
            this.checkedSize = size;
        },
        handleAddToCart() {
            if (this.propProduct.stock_status === 'out_of_stock') {
                location.href = this.propProduct.publish_url
            } else {
                this.addToCart({ ...this.product, ...{ quantity: this.quantity || 1}, ...{size: this.checkedSize } })
            }
        },
        isAddedToCart(id) {
            return Boolean(this.$store.getters.cartItems.find(i => Number(i.id) === Number(id)))
        },
    },
    computed: {
        product() {
            return this.mapCartItem(this.propProduct);
        },
    }
}
</script>
<style scoped>
.added {
    background: #c7009d;
}
.added .fa-shopping-bag {
    color: #555353;
}
.disabled {
    background-color: #555353 !important;
    cursor: not-allowed ! important;
}
.disabled .fa-shopping-bag {
    color: #fff;
}
.sizes {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    width: 100%;
    gap: 2px;
    margin-top: 6px;
}
.ad {
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.add :hover{
    width: 100%;
    height: 100%;
}
.ad:hover {
    background-color: #c7009d;
    color: #fff;
}
.ad:focus {
    background-color: #c7009d;
    /* color: #fff!important; */
}
.ad label {
    color: #c7009d;
}
.sizes input[type="radio"]:checked+label {
    background-color: #c7009d;
    color: white;
    border: solid 0.5px #c7009d;
}
.ad:focus {
    background-color: #c7009d;
}
</style>
