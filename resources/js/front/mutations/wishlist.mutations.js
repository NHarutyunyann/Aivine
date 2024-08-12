export default {
    ADD_TO_WISHLIST (state, payload) {
        const index = state.wishlist.items.findIndex(i => i.id === payload.id)

        if(!state.wishlist.items[index]) {
            state.wishlist.items.push(payload)
        }
    },

    LOAD_WISHLIST (state, {items = []}) {
        state.wishlist.items = items
    },
    STORE_WISHLIST_HASH (state, payload) {
        state.wishlistHash = payload || null
    },
    REMOVE_FROM_WISHLIST (state, payload) {
        const index = state.wishlist.items.findIndex(i => i.id === payload)
        if(index !== -1) {
            state.wishlist.items.splice(index, 1)
        }
    },
}
