<template>
    <div id="collapseSix" class="collapse show" aria-labelledby="headingSix" data-parent="#accordion">
        <h2>Վճարված գումարներ</h2>
        <p>Այս էջում կարող եք տեսնել ամսվա սկզբից Ձեր վճարած գումարները ամսաթվով։</p>
        <table>
            <thead>
            <tr>
                <th>Վճարված գումար</th>
                <th>Վճարման ամսաթիվ</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="payment in $store.getters.accountPayments">
                <td>{{ priceFormatter(payment.sum, $store.getters.currency, $store.getters.currencyRates) }}</td>
                <td>{{ payment.date }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import {mapActions} from "vuex";

export default {
    beforeMount() {
        this.getPayedPrices()
    },
    methods: {
        ...mapActions(['getPayedPrices'])
    }
}
</script>
