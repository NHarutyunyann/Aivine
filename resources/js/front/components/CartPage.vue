<template>
    <div class="row" :class="{ loader: $store.getters.loading }">

        <div class="card">
            <div class="row">
                <div class="col-md-8 cart">
                    <div class="title">
                        <div class="row">
                            <div class="col">
                                <h4><b>Հավանած մոդելներ</b></h4>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-bottom">
                        <div class="row main align-items-center">
                            <div class="row main align-items-center product_info">
                                <div class="col col_first">
                                    <p>Նկար</p>
                                </div>
                                <div class="col">
                                    <P>Մոդել</P>
                                </div>
                                <div class="col">
                                    <p>Չափս</p>
                                </div>
                                <div class="col">
                                    <p>Քանակ</p>
                                </div>
                                <div class="col">
                                    <p>Արժեք</p>
                                </div>
                                <div class="col">
                                    <p>Հեռացնել</p>
                                </div>
                            <hr>

                            </div>

                            <div class="row" v-for="(item, key) in $store.getters.cartItems">
                                <div class="row main align-items-center">
                                    <div class="col-2 col">
                                        <a :href="item.url" class="desktop-hide image">
                                            <img :src="item.image" :alt="item.title">
                                        </a>
                                    </div>
                                    <div class="col sku">
                                        <a :href="item.url" class="title">{{ item.title }}</a>
                                    </div>
                                    <div class="col">
                                        <p>{{ item.size }}</p>
                                    </div>
                                    <div class="col">
                                        <div class="quantity">
                                            <button @click="decrementQty(item, item.quantity - qtyStep(item))">-</button>
                                            <input style="max-width: 3rem" class="form-control text-center me-3"
                                                id="inputQuantity" type="text" :step="qtyStep" value="1"
                                                @focusout="onQuantityInput(item, $event.target.value)"
                                                v-model="item.quantity" />
                                            <button @click="incrementQty(item, item.quantity + qtyStep(item))">+</button>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <span v-if="item.discount_price" class="amount amount-refined">{{
                                            priceFormatter(item.discount_price * item.quantity, $store.getters.currency,
                                                $store.getters.currencyRates) }}</span> <span
                                            class="amount">{{ priceFormatter(item.regular_price * item.quantity,
                                                $store.getters.currency, $store.getters.currencyRates) }}</span>
                                    </div>
                                    <div class="col remove">
                                        <p @click="removeFromCart(item.id)" class="desktop-hide remove">
                                            <img width="25" height="25" src="https://img.icons8.com/ios/50/c7009d/delete-sign--v1.png" alt="delete-sign--v1" />
                                        </p>
                                    </div>
                                    <hr >
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--  delivery address -->
                </div>
                <div class="col-md-4 summary">
                    <div>
                        <h5><b>Պատվերի ամփոփում</b></h5>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col" style="padding-left:0;">Ապրանքների գումարային արժեքը</div>
                        <div class="col text-right">{{ priceFormatter($store.getters.cartTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</div>
                    </div>
                    <form method="get" action="/order-registration">
                        <!-- @csrf -->
                        <h6>Խնդրում ենք լրացնել առաքման տվյալները</h6>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="full_name">Անուն Ազգանուն</label>
                            <input type="text" name="full_name" id="full_name" placeholder="Անուն Ազգանուն"
                                class="form-control " />
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="phone">Հեռախոսահամար</label>
                            <div class="divik">
                                <span class="border-end country-code px-2">+374</span>
                                <input type="text" name="phone" id="phone" minlength="8" maxlength="9" style="width: 100%"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="region">Մարզ / Շրջան</label>
                            <select name="region" style="background-color: white;" class="form-control ">
                                <option value="Երևան" class="text-muted">Երևան</option>
                                <option value="Արագածոտն" class="text-muted">Արագածոտն</option>
                                <option value="Արարատ" class="text-muted">Արարատ</option>
                                <option value="Արմավիր" class="text-muted">Արմավիր</option>
                                <option value="Լոռի" class="text-muted">Լոռի</option>
                                <option value="Կոտայք" class="text-muted">Կոտայք</option>
                                <option value="Շիրակ" class="text-muted">Շիրակ</option>
                                <option value="Սյունիք" class="text-muted">Սյունիք</option>
                                <option value="Վայոց ձոր" class="text-muted">Վայոց ձոր</option>
                                <option value="Տավուշ" class="text-muted">Տավուշ</option>
                            </select>
                        </div>
                        <div class="form-outline mb-4">
                            <fieldset>
                                <label class="form-label" for="city">Քաղաք/ Վարչական շրջան</label>
                                <input type="text" name="city" id="city" class="form-control " />
                            </fieldset>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="address"> Փողոց </label>
                            <input type="text" name="address" id="address" class="form-control " />
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="code"> Փոստային կոդ </label>
                            <input type="number" name="postal_code" id="code" class="form-control" />
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="code">Ընտրել Վճարման տարբերակը</label>
                            <select name="payment_type" style="background-color: white;" class="form-control ">
                                <option value="Վճարել տեղում" class="text-muted">Վճարել տեղում</option>
                                <option value="Վճարել հիմա" class="text-muted">Վճարել հիմա</option>
                            </select>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label" for="message"> Այլ նշումներ </label>
                            <textarea type="text" name="message" class="form-control" /></textarea>
                        </div>
                        <div class="row" style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div class="col">Վճարման ենթակա գումարը</div>
                            <div class="col text-right">{{ priceFormatter($store.getters.cartTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</div>
                        </div>
                        <button type="submit" class="btn user-registration">Պատվերի</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- <div v-if="$store.getters.cartItems.length" class="col-lg-4 pr-4 pl-4">
            <div class="cart-box">
                <h3>Զաբմյուղ</h3>
                <table>
                    <tbody>
                    <tr class="cart-subtotal">
                        <th>Արժեքը</th>
                        <td>
                         --   <span>{{ priceFormatter($store.getters.cartTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</span>
                        </td>
                    </tr>
                    <tr class="order-total">
                        <th>Ընդհանուր</th>
                        <td>
                            <span class="amount-refined" v-if="$store.getters.cartTotalDiscount">{{ priceFormatter($store.getters.cartDiscountedTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</span>
                            <span class="amount">{{ priceFormatter($store.getters.cartTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</span>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="proceed-to-checkout-box">
                    <h3>Առաքման տեսակ</h3>
                    <div class="radio-btn-box">
                        <input type="radio" value="deliver" v-model="delivery_type" @change="onDeliveryTypeChange" id="deliver" name="delivery_type" />
                        <label for="deliver">Առաքում</label>
                    </div>
                    <div class="radio-btn-box">
                        <input type="radio" value="self_transport" v-model="delivery_type" @change="onDeliveryTypeChange" id="self_transport" name="delivery_type" />
                        <label for="self_transport">Ինքնափոխադրում</label>
                    </div>
                    <button @click="handleEmptyCart">Մաքրել զամբյուղը</button>
                    <a href="javascript:" @click="handleCheckoutClicked" class="btn-checkout">Ձևակերպել</a>
                </div>
            </div>
        </div>

        <div v-if="$store.getters.cartItems.length" class="col-lg-8 order-lg-first pr-4 pl-4">
            <div class="checkout-payment">
                <form>
                    <div class="cart-table-section">
                        <table>
                            <thead>
                            <tr>
                                <th class="product-remove"></th>
                                <th class="product-thumbnail"></th>
                                <th class="product-name">Ապրանք</th>
                                <th class="product-price">Գինը</th>
                                <th class="product-quantity">Քանակը</th>
                                <th class="product-subtotal">Արժեքը</th>
                            </tr>
                            </thead>
                            <tbody>
                            <template v-for="(grouped, key) in $store.getters.cartItemsGroupedByCategory">
                                <tr v-if="grouped.category">
                                    <td class="cat-title" colspan="6">
                                        <h3>{{ grouped.category.name }}</h3>
                                    </td>
                                </tr>
                                <tr class="product-data" v-for="item in grouped.items">
                                    <td class="product-remove">
                                        <a @click="removeFromCart(item.id)">×</a>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a :href="item.url">
                                            <img loading="lazy" width="400" height="282" :src="item.image" :alt="item.title">
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a :href="item.url" class="desktop-hide image">
                                            <img loading="lazy" width="400" height="282" :src="item.image" :alt="item.title">
                                        </a>
                                        <a :href="item.url" class="title">{{ item.title }}</a>
                                        <a @click="removeFromCart(item.id)" class="desktop-hide remove">×</a>
                                    </td>
                                    <td data-label="Գինը" class="product-price">
                                        <span class="amount">{{ priceFormatter(item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
                                    </td>
                                    <td data-label="Քանակը" class="product-quantity">
                                        <div class="quantity">
                                            <span @click="decrementQty(item, item.quantity - qtyStep(item))">-</span>
                                            <input type="text" :step="qtyStep" value="1" @focusout="onQuantityInput(item, $event.target.value)" v-model="item.quantity"/>
                                            <span @click="incrementQty(item, item.quantity + qtyStep(item))">+</span>
                                        </div>
                                    </td>
                                    <td data-label="Արժեքը" class="product-subtotal">
                                        <span v-if="item.discount_price" class="amount amount-refined">{{ priceFormatter(item.discount_price * item.quantity, $store.getters.currency, $store.getters.currencyRates) }}</span>
                                        <span class="amount">{{ priceFormatter(item.regular_price * item.quantity, $store.getters.currency, $store.getters.currencyRates) }}</span>
                                    </td>
                                </tr>
                                <tr class="total-price">
                                    <td colspan="6">
                                        <h4>Ընդհանուր</h4>
                                        <span v-if="grouped.total_discount" class="amount amount-refined">{{ priceFormatter(grouped.discounted_total_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
                                        <span class="amount">{{ priceFormatter(grouped.total_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
                                    </td>
                                </tr>
                            </template>
                            </tbody>
                        </table>
                    </div>
                </form>

            </div>
        </div>

        <div v-if="$store.getters.cartLoaded && !$store.getters.cartItems.length" :style="{'visibility': $store.getters.loading ? 'hidden' : 'initial'}" class="col-12 pr-4 pl-4 empty-cart-box">
            <img loading="lazy" src="/images/empty-cart-icon.png" />
            <h1>Ձեր զամբյուղը դատարկ է</h1>
            <p>Զամբյուղը դատարկ է, պատվեր ձևակերպելու համար ավելացրեք ապրանքներ զամբյուղի մեջ։</p>
            <a href="/shop">ՎԵՐԱԴԱՌՆԱԼ ԳՆՈՒՄՆԵՐԻ</a>
        </div>-->
    </div>
</template>
<style scoped>
.col{
    display:flex;
    justify-content: center;
}
.remove{
    cursor: pointer;
}

@media screen and ( max-width: 991px) {
    .product_info{
        display: none;
    }

}
@media screen and (max-width:1170px){
    .image img{
        width: 150px;
    }
}
</style>
<script>
import { mapActions, mapState } from "vuex"
import Notifications from "./Notifications";

export default {
    components: { Notifications },
    computed: {
        ...mapState(['billing_info']),
        delivery_type: {
            get() {
                return this.billing_info.delivery_type;
            },
            set(value) {
                this.$store.commit('INSERT_INITIAL_DATA', { billing_info: { delivery_type: value } });
            }
        }
    },
    beforeMount() {
        this.getDebtPrices();
    },
    methods: {
        ...mapActions(['removeFromCart', 'updateCartQuantity', 'removeAllCartItems', 'getDebtPrices', 'emptyNotes', 'checkWeightLimit']),
        handleEmptyCart() {
            if (confirm("Դուք ցանկանու՞մ եք ջնջել զամբյուղի պարունակությունը")) {
                this.removeAllCartItems()
            }
        },
        handleCheckoutClicked() {
            if (this.$store.getters.auth) {
                this.checkWeightLimit().then(([error, res]) => {
                    if (res) {
                        location.href = '/checkout'
                    }
                });
            } else {
                location.href = '/checkout'
            }
        },
        incrementQty(item, value) {
            this.updateQuantity(item, value)
        },
        decrementQty(item, value) {
            this.updateQuantity(item, value)
        },
        onQuantityInput(item, value) {
            this.updateQuantity(item, value)
        },
        updateQuantity(item, value) {
            let quantity = isNaN(Number(value)) || Number(value) <= 0 ? 1 : Number(value);

            quantity = quantity > item.stock ? item.stock : quantity;

            if (item.min_quantity && item.min_quantity > quantity) {
                quantity = item.min_quantity;
            }

            quantity = this.getQtyGrouped(item, quantity);
            if (item.max_quantity && item.max_quantity < quantity) {
                quantity = item.max_quantity
            }

            quantity = quantity > 99999 ? 99999 : quantity;

            this.emptyNotes();
            this.updateCartQuantity({ id: item.id, quantity }).then(res => {
                this.checkWeightLimit().then(([error, data]) => {
                    if (!error) {
                        this.emptyNotes();
                    }
                })
            })
        },
        onDeliveryTypeChange() {
            this.emptyNotes();
            this.checkWeightLimit().then(([error]) => {
                if (!error) {
                    this.emptyNotes();
                }
            })
        },
        qtyStep(product) {
            if (product.group_of) {
                const min_value = product.group_of > product.min_quantity ? product.group_of : product.min_quantity;
                return min_value || 1;
            } else {
                return 1
            }
        },
        getQtyGrouped(item, qty) {
            if (item.group_of && item.group_of > 1 && (qty / item.group_of) % 1 !== 0) {
                return qty - qty % item.group_of + item.group_of
            }
            return qty
        },
    },
    watch: {
        '$store.getters.cartLoaded': function (isCartLoaded) {
            if (isCartLoaded) {
                this.checkWeightLimit()
            }
        }
    }
}
</script>
