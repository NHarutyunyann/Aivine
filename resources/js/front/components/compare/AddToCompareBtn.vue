<template>
    <div class="d-flex">
        <a v-if="!isSelected" href="javascript:" @click.stop.prevent="addToCompare(product)" class="compare-btn">
            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet"  viewBox="0 0 36 36"><path d="M21.61 11h8.62l-3.3 3.3a1 1 0 1 0 1.41 1.42L34 10.08l-.71-.71l-4.95-4.94a1 1 0 0 0-1.41 1.42L30.11 9H21a1 1 0 0 0-.86.5l-2.64 4.59l1.16 2Z" class="clr-i-outline clr-i-outline-path-1"/><path d="M11.07 25.07H3a1 1 0 0 0 0 2h8.65a1 1 0 0 0 .86-.5L15.18 22L14 20Z" class="clr-i-outline clr-i-outline-path-2"/><path d="M28.34 20.17a1 1 0 0 0-1.41 1.42l3.5 3.5h-8.82l-9.1-15.56a1 1 0 0 0-.86-.5H3a1 1 0 1 0 0 2h8.07l9.1 15.55a1 1 0 0 0 .86.5h8.87l-3 3a1 1 0 0 0 1.41 1.42l4.95-4.94l.71-.71Z" class="clr-i-outline clr-i-outline-path-3"/><path fill="none" d="M0 0h36v36H0z"/></svg>
            <span>Համեմատել</span>
        </a>
        <a v-if="isSelected" href="javascript:" @click.stop.prevent="goToCompare" class="compare-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 24 24"><path fill="none" stroke="#069" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m4 12l6 6L20 6"/></svg>            <span>Համեմատել ապրանքները</span>
        </a>
    </div>
</template>
<script>
import {mapActions} from "vuex";

export default {
    props: ['product'],
    methods: {
        ...mapActions(['addToCompare', 'removeFromCompare']),
        goToCompare() {
            location.href = '/compare'
        }
    },
    computed: {
        isSelected() {
            return this.$store.getters.compareItems.find(i => i.id === this.product.id)
        }
    }
}
</script>
