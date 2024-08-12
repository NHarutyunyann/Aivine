import VuexPersistence from 'vuex-persist'
import state from './state'
import getters from './getters'
import actions from './actions'
import mutations from './mutations'
import createMutationsSharer from "vuex-shared-mutations";

const vuexLocal = new VuexPersistence({
    storage: window.localStorage,
    reducer: (state) => ({
        cartHash: state.cartHash,
        wishlistHash: state.wishlistHash,
        compare_items: state.compare_items,
        billing_info: state.billing_info,
        notifications: state.notifications,
        last_seen_items: state.last_seen_items,
        currency: state.currency,
    }),
})

let store = {
    state,
    getters,
    actions,
    mutations,
    plugins: [vuexLocal.plugin, createMutationsSharer({ predicate: [
        "ADD_TO_CART", "UPDATE_CART_QUANTITY", "LOAD_CART", "STORE_CART_HASH", "REMOVE_FROM_CART", "SET_CURRENCY_RATES"
        ]
    })]
}

export default store
