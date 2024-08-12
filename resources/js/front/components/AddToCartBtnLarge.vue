<template>
    <div>
        <div class = "d-flex" style="gap: 5px;">
            <p>Չափս</p>
            <p>{{" " + this.checkedSize}}</p>
        </div>
        <div v-if="this.propProduct.sizes.length > 0" class="btn-group sizes ">
            <div class="ad" v-for="size in this.propProduct.sizes">
                <input @click="addSize(size.size)" type="radio" :value="size.size" class="btn-check ad" :id="size.size" name="size">
                <label class="btn btn-default ad" :for="size.size">{{ size.size }}</label>
            </div>
        </div>
        <div class="d-flex mt-2 add-to-cart-box" :class="{ outOfStock: propProduct.stock_status === 'out_of_stock'}" style="width: 100%;">
            <a href="javascript:" @click="handleAddToCart" :class="{ 'added': isAddedToCart(propProduct.id), 'disabled': propProduct.stock_status === 'out_of_stock' }" style="width: 100%;">
                <span v-if="propProduct.stock_status !== 'out_of_stock' && isAddedToCart(propProduct.id)" style="width: 100%;">Ավցելացված է</span>
                <span v-if="propProduct.stock_status !== 'out_of_stock' && !isAddedToCart(propProduct.id)" style="width: 100%;">Ավելացնել զամբյուղի մեջ</span>
                <span v-if="propProduct.stock_status === 'out_of_stock'" style="width: 100%;">Ավելացնել զամբյուղի մեջ</span>
            </a>
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
.add-btn {
    padding: 0;
}
.sizes input[type="radio"] {
    display: none;
}
.sizes label {
    display: inline-block;
    background-color: #e472cb;
    color: white;
    padding: 4px 11px;
    font-size: 16px;
    cursor: pointer;
}
.sizes input:hover {
    background-color: #da00aa;
}
.sizes label:hover {
    background-color: #da00aa;
}
.sizes input[type="radio"]:checked+label {
    background-color: #c7009d;
    color: white;
}
.ad:focus {
    background-color: #c7009d;
}
.sizes {
    background-color: #fbf4fa;
    width: auto;
    max-width: 100%;
    gap: 2px;
    flex-wrap: wrap !important;
}
.added {
    cursor: not-allowed ! important;
}
.added:hover {
    cursor: not-allowed ! important;
}
a {
    text-decoration: none;
    color: #fff;
    background-color: #da00aa;
    height: 45px;
    width: 250px;
    border-radius: 7px;
}
a span {
    height: 45px;
    width: 250px;
    border-radius: 7px;
    display: flex;
    justify-content: center;
    align-items: center;
}
a:hover {
    background-color: #c7009d;
}
.disabled {
    background-color: #555353 !important;
    cursor: not-allowed ! important;
}
.disabled .fa-shopping-bag {
    color: #fff;
}
</style>
