<template>
    <div class="product-weight-volume-box">
        <p v-if="$store.getters.cartTotalWeightAndVolume && $store.getters.cartTotalWeightAndVolume.weight">
            <i class='fas fa-balance-scale'></i>
            Ընդհանուր քաշը` {{ decimalFormatter($store.getters.cartTotalWeightAndVolume.weight) }}կգ
        </p>
        <p v-if="$store.getters.cartTotalWeightAndVolume && $store.getters.cartTotalWeightAndVolume.volume">Ընդհանուր ծավալը`
            {{ decimalFormatter($store.getters.cartTotalWeightAndVolume.volume) }} խմ</p>
    </div>
</template>
<script>
export default {

}
</script>
