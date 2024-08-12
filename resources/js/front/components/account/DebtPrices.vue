<template>
    <div class="debt-box">
        <div class="debt-header-box">
            <div>
                <h5>Ձեր պարտքը կազմում է</h5>
                <h5 v-if="$store.getters.totalLateDebt">Ուշացումներ</h5>
            </div>
            <div>
                <h4 class="frstH4">{{ priceFormatter($store.getters.totalDebt, $store.getters.currency, $store.getters.currencyRates)}}</h4>
                <h4 v-if="$store.getters.totalLateDebt">{{ priceFormatter($store.getters.totalLateDebt, $store.getters.currency, $store.getters.currencyRates)}}</h4>
                <a href="javascript:" @click="onRefreshDebtPrices">Թարմացնել</a>
            </div>
        </div>
        <table>
            <thead>
            <tr>
                <td>Պատվերի համարը</td>
                <td>Վճարման ենթակա գումարի չափ</td>
                <td>Վճարման ամսաթիվ</td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="debt in $store.getters.accountDebtPrices">
                <td>
                    <a v-if="debt.order" :href="debt.order.view_url">#{{ debt.order.id }}</a>
                </td>
                <td :class="{late: debt.is_late}">{{ priceFormatter(debt.sum, $store.getters.currency, $store.getters.currencyRates) }}</td>
                <td :class="{late: debt.is_late}">{{ debt.date }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import {mapActions} from "vuex";
import Notifications from "../Notifications";

export default {
    components: {Notifications},
    methods: {
        ...mapActions(['emptyNotes']),
        onRefreshDebtPrices() {
            this.getDebtPrices().then(res => {
                this.emptyNotes();
            })
        }
    }
}
</script>
