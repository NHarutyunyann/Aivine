<template>
    <div class="row px-lg-5 py-5 my-3">
        <div class="offset-lg-2 col-lg-8 col-12 offset-0 px-lg-5 order-received-content-box">
            <h2 class="thank-you-text">Շնորհակալություն, Ձեր պատվերը կատարվել է։</h2>
            <div class="info-content">
                <div class="info-box">
                    <p>Պատվերի համարը։</p>
                    <span>{{ order.id }}</span>
                </div>
                <div class="info-box">
                    <p>Ամսաթիվ․</p>
                    <span>{{ moment(order.created_at).format('DD.MM.yyyy') }}</span>
                </div>
                <div class="info-box">
                    <p>Ընդհանուր գումար։</p>
                    <span>{{ priceFormatter(order.total, $store.getters.currency, $store.getters.currencyRates) }}</span>
                </div>
                <div class="info-box">
                    <p>Վճարման համակարգը։</p>
                    <span>{{ order.payment_type === 'bank_transfer' ? 'Բանկային փոխանցում' : 'Վճարել տեղում' }}</span>
                </div>
            </div>
            <span class="info-text">{{ order.payment_type === 'bank_transfer' ? 'Բանկային փոխանցում' : 'Վճարել տեղում' }}` պատվերը ստանալուց</span>
            <div class="order-info">
                <h3>Պատվերի տվյալներ</h3>
                <div class="order-info-table">
                    <table>
                        <thead>
                        <tr>
                            <th>ԱՆՎԱՆՈՒՄ</th>
                            <th>ՔԱՆԱԿ</th>
                            <th>ՀԱՏԻ ԱՐԺԵՔ</th>
                            <th>ԸՆԴՀԱՆՈՒՐ</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="item in order.items">
                            <td>
                                <a :href="item.product?.publish_url">{{ item.title }}</a>
                            </td>
                            <td>{{ item.quantity }}</td>
                            <td>{{ priceFormatter(item.price, $store.getters.currency, $store.getters.currencyRates) }}</td>
                            <td>{{ priceFormatter(item.price  * item.quantity, $store.getters.currency, $store.getters.currencyRates) }}</td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th colspan="4">
                                Վճարման համակարգը։ <span class="float-right strong">{{ order.payment_type === 'bank_transfer' ? 'Բանկային փոխանցում' : 'Վճարել տեղում' }}</span>
                            </th>
                        </tr>
                        <tr>
                            <th colspan="4">
                                Ընդհանուր գումար։ <span class="float-right">{{ priceFormatter(order.total, $store.getters.currency, $store.getters.currencyRates) }}</span>
                            </th>
                        </tr>
                        <tr v-if="order.discount">
                            <th colspan="4">
                                Զեղչ։ <span class="float-right">-{{ order.discount }}</span>
                            </th>
                        </tr>
                        <tr v-if="order.discount">
                            <th colspan="4">
                                Զեղչված արժեքը։ <span class="float-right">{{ priceFormatter(order.discounted_total, $store.getters.currency, $store.getters.currencyRates) }}</span>
                            </th>
                        </tr>
                        <tr>
                            <th>Մեկնաբանություն:</th>
                            <td colspan="3" v-html="order.additional_info"></td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "order-received",
    props: ['order']
}
</script>

<style scoped>

</style>
