<template>
    <li class="nav-item icon">
        <a class="nav-link  header-icon" href="/shopping" role="button" aria-expanded="false">
            <img width="30" height="30" src="https://img.icons8.com/pastel-glyph/64/c7009d/paper-bag--v1.png" alt="paper-bag--v1"/>
            Իմ զամբյուղը
            <span class="badge badge-primary badge-pill span"  >{{ $store.getters.cartItems.length }}</span>
        </a>
        
    </li>
</template>
<style scoped>
.icon{
    position: relative;
}
.span{
    background-color:rgb(199, 0, 157);
    border-radius: 20px;
    position: absolute;
    top: 10px;
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
}
</script>