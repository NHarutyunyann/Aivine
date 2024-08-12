<template>
    <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordion">
        <table class="orders-table">
            <thead>
            <tr>
                <th>Պատվեր</th>
                <th>Ամսաթիվ</th>
                <th>Կարգավիճակ</th>
                <th>Ընդհանուր</th>
                <th>Գործողություններ</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="order in orders">
                <td data-label="Պատվեր">
                    <a :href="order.view_url">#{{ order.id }}</a>
                </td>
                <td data-label="Ամսաթիվ">{{ moment(order.created_at).format('DD.MM.yyyy') }}</td>
                <td data-label="Կարգավիճակ">{{ propOrderStatuses[order.status] }}</td>
                <td data-label="Ընդհանուր">
                    <span>{{ priceFormatter(order.discounted_total || order.total, $store.getters.currency, $store.getters.currencyRates) }}</span> - {{ order.items.reduce((a, b) => a + (Number(b.quantity) || 0), 0) }} ապրանքների համար
                </td>
                <td data-label="Գործողություններ">
                    <a :href="order.view_url" class="button view">Տեսնել</a>
                    <a v-if="order.status === 'completed'" href="javascript:" @click="handleOrderAgain(order.id)" class="button view">Պատվիրել կրկին</a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
import {mapActions} from "vuex";
import Notifications from "../Notifications";

export default {
    props: ['propOrderStatuses'],
    components: {Notifications},
    beforeMount() {
        this.getOrders()
    },
    data() {
      return {
          orders: [],
      }
    },
    methods: {
        ...mapActions(['handleOrderAgain']),
        getOrders () {
            this.$store.commit('LOADING')
            axios.get('/my-account/get-orders').then(({data}) => {
                this.orders = data.orders || []
                this.$store.commit('LOADING', false)
            }).catch(e => {
                console.error('error:', e.message)
                this.$store.commit('LOADING', false)
            });
        },
    }
}
</script>
