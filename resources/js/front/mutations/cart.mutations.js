import mapCartItem from "../../services/map-cart-item";

export default {
    ADD_TO_CART (state, payload) {
        const index = state.cart.items.findIndex(i => i.id === payload.id)

        if(state.cart.items[index]) {
            state.cart.items[index].quantity += Number(payload.quantity)
        } else {
            state.cart.items.push(payload)
        }
    },
    UPDATE_CART_QUANTITY (state, payload) {
        const index = state.cart.items.findIndex(i => i.id === payload.id)
        if(state.cart.items[index]) {
            state.cart.items[index].quantity = Number(payload.quantity);
        }

        console.log('state.cart.items[index]: ', state.cart.items[index])
    },
    LOAD_CART (state, {items = []}) {
        state.cart.items = items.map(mapCartItem)
    },
    STORE_CART_HASH (state, payload) {
        state.cartHash = payload || null
        state.app.cartLoaded = true
    },
    REMOVE_FROM_CART (state, payload) {
        const index = state.cart.items.findIndex(i => i.id === payload)
        if(index !== -1) {
            state.cart.items.splice(index, 1)
        }
    },
}
