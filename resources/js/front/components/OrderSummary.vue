<template>
   <div id="scrollTop">
       <table class="shop-table">
           <thead>
           <tr>
               <th class="product-name">Ապրանք</th>
               <th class="product-total">Արժեքը</th>
           </tr>
           </thead>
           <tbody class="t-open">
           <tr v-for="(item, index) in $store.getters.cartItems" v-if="showItemsAll || index < 4">
               <td class="product-name">
                   {{ item.title }}
                   <strong class="product-quantity"> × {{ item.quantity }}</strong>
               </td>
               <td class="product-total">
                   <span>{{ priceFormatter(item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</span>
               </td>
           </tr>
           </tbody>
       </table>
       <div class="see-more-all" v-if="$store.getters.cartItems.length > 4">
           <p v-if="!showItemsAll" @click="handleListOpen" class="see-more-p">Տեսնել ամբողջ զամբյուղը<img src="/images/icons/vectorright.svg"></p>
           <p v-if="showItemsAll" @click="handleListClose" class="close-more-p"><img src="/images/icons/vectorleft.svg">Փակել ցուցակը </p>
       </div>
       <table class="shop-table">
           <tfoot>
           <tr class="cart-subtotal">
               <th>Արժեքը</th>
               <td>
                   <span>{{ priceFormatter($store.getters.cartTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</span>
               </td>
           </tr>
           <tr v-if="$store.getters.cartTotalDiscount" class="cart-subtotal">
               <th>Զեղչ</th>
               <td>
                   <span>-{{ priceFormatter($store.getters.cartTotalDiscount, $store.getters.currency, $store.getters.currencyRates) }}</span>
               </td>
           </tr>
           <tr id="scrollDown" class="order-total">
               <th>Ընդհանուր</th>
               <td>
                   <span>{{ priceFormatter($store.getters.cartDiscountedTotalPrice, $store.getters.currency, $store.getters.currencyRates) }}</span>
               </td>
           </tr>
           </tfoot>
       </table>
   </div>
</template>

<script>
export default {
    data: () => {
        return {
            showItemsAll: false
        }
    },
    methods: {
        handleListClose() {
            this.showItemsAll = false;
            this.$nextTick(function () {
                this.scrollIntoViewWithOffset('#scrollTop', 200);
            })
        },
        handleListOpen() {
            this.showItemsAll = true;
            this.$nextTick(function () {
                this.scrollIntoViewWithOffset('#scrollDown', 500);
            })
        },
        scrollIntoViewWithOffset(selector, offset) {
            window.scrollTo({
                behavior: 'smooth',
                top:
                    document.querySelector(selector).getBoundingClientRect().top -
                    document.body.getBoundingClientRect().top -
                    offset,
            })
        }
    }
}
</script>

