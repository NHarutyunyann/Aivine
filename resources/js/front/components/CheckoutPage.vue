<template>
    <div class="row checkout-page" :class="{loader: !$store.getters.cartLoaded || $store.getters.loading}">
        <div v-if="$store.getters.cartItems.length" class="col-12 col-lg-6">
            <div class="cart-form">
                <h3>Առաքման տվյալներ</h3>
                <form>
                    <div class="form-half-box">
                        <div class="form-box">
                            <label>Անուն<span>*</span></label>
                            <input
                                type="text"
                                :class="{invalid: errors.first_name}"
                                v-model="billing_info.first_name"
                            />
                            <span v-if="errors.first_name" class="error">{{ errors.first_name }}</span>
                        </div>
                        <div class="form-box">
                            <label>Ազգանուն<span>*</span></label>
                            <input
                                type="text"
                                :class="{invalid: errors.last_name}"
                                v-model="billing_info.last_name"
                            />
                            <span v-if="errors.last_name" class="error">{{ errors.last_name }}</span>
                        </div>
                    </div>
                    <div class="form-box">
                        <label>Ընկերության անվանումը (պարտադիր չէ)</label>
                        <input
                            type="text"
                            :class="{invalid: errors.company_name}"
                            v-model="billing_info.company_name"
                        />
                        <span v-if="errors.company_name" class="error">{{ errors.company_name }}</span>
                    </div>
                    <div class="form-box">
                        <label>Հասցե<span>*</span></label>
                        <input
                            type="text"
                            placeholder="Շենք, տուն/բնակարան"
                            :class="{invalid: errors.address}"
                            v-model="billing_info.address"
                        />
                        <span v-if="errors.address" class="error">{{ errors.address }}</span>
                    </div>
                    <div class="form-box">
                        <label>Մարզ/Քաղաք<span>*</span></label>
                        <input
                            type="text"
                            :class="{invalid: errors.city}"
                            v-model="billing_info.city"
                        />
                        <span v-if="errors.city" class="error">{{ errors.city }}</span>
                    </div>
                    <div class="form-box">
                        <label>Հեռախոսահամար<span>*</span></label>
                        <input
                            type="text"
                            :class="{invalid: errors.phone_number}"
                            v-model="billing_info.phone_number"
                        />
                        <span v-if="errors.phone_number" class="error">{{ errors.phone_number }}</span>
                    </div>
                    <div class="textarea-form-box">
                        <h3>Հավելյալ ինֆորմացիա</h3>
                        <div class="form-box">
                            <label>Նշումներ պատվերի վերաբերյալ (պարտադիր չէ)</label>
                            <textarea
                                :class="{invalid: errors.additional_info}"
                                v-model="billing_info.additional_info"
                            ></textarea>
                            <span v-if="errors.additional_info" class="error">{{ errors.additional_info }}</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div v-if="$store.getters.cartItems.length" class="col-12 col-lg-6">
            <div class="cart-order">
                <h3>Ձեր պատվերը</h3>
                <div class="shop-table-box">
                    <order-summary />
                </div>
                <div class="cart-form-bottom-box">
                    <div class="cart-form-radio-box">
                        <div v-if="this.$store.getters.auth.allow_bank_transfer">
                            <input type="radio" value="bank_transfer" v-model="billing_info.payment_type" id="bank_transfer" name="payment_type" />
                            <label for="bank_transfer">Բանկային փոխանցում</label>
                        </div>
                        <div v-if="this.$store.getters.auth.allow_on_deliver">
                            <input type="radio" value="on_deliver" v-model="billing_info.payment_type" id="on_deliver" name="payment_type" />
                            <label for="on_deliver">Վճարել տեղում</label>
                        </div>
                    </div>
                    <div class="cart-form-button-box">
                        <p>Ձեր անձնական տվյալները կօգտագործվեն ձեր պատվերի մշակման համար կայքում:</p>
                        <button @click="onCheckoutSubmit">Պատվիրել</button>
                    </div>
                </div>
            </div>
        </div>
        <div v-if="$store.getters.cartLoaded && !$store.getters.cartItems.length" :style="{'visibility': $store.getters.loading ? 'hidden' : 'initial'}" class="col-12 pr-4 pl-4 empty-cart-box">
            <img loading="lazy" src="/images/empty-cart-icon.png" />
            <h1>Ձեր զամբյուղը դատարկ է</h1>
            <p>Զամբյուղը դատարկ է, պատվեր ձևակերպելու համար ավելացրեք ապրանքներ զամբյուղի մեջ։</p>
            <a href="/shop">ՎԵՐԱԴԱՌՆԱԼ ԳՆՈՒՄՆԵՐԻ</a>
        </div><!-- End .col-lg-4 -->
    </div>
</template>


<script>
import {mapActions, mapState} from "vuex"

export default {
    data() {
      return {
          errors: {},
      }
    },
    computed: {
        ...mapState(['billing_info']),
    },
    methods: {
        ...mapActions(['processCheckout', 'removeAllCartItems']),
        async onCheckoutSubmit() {
            const [error, data] = await this.processCheckout()
            if(error) {
                if(data && data.validation_errors) {
                    this.errors = data.validation_errors
                } else {

                }
            } else {
                this.$store.commit('LOADING')
                this.removeAllCartItems();
                location.href = `/checkout/order-received/${data.response}`
            }
        }
    },
}
</script>
<style scoped>
.error {
    position: relative!important;
}
</style>
