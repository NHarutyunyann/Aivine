export default {
    loadWishlist ({ commit, state }) {
        axios.get(`/wishlist/load${state.wishlistHash ? '/' + state.wishlistHash : ''}`).then((response) => {
            commit('LOAD_WISHLIST', response.data.wishlist || {items: []})
            commit('STORE_WISHLIST_HASH', response.data.hash)
        });
    },
    saveWishlist ({ commit, state }) {
        axios.put(`/wishlist/save${state.wishlistHash ? '/' + state.wishlistHash : ''}`, {wishlist: state.wishlist}).then((response) => {
            commit('STORE_WISHLIST_HASH', response.data.hash)
        });
    },
    addToWishlist ({ commit, dispatch }, wishlistItem) {
        commit('ADD_TO_WISHLIST', wishlistItem)
        dispatch('saveWishlist')
    },
    removeFromWishlist ({ commit, dispatch }, itemId) {
        commit('REMOVE_FROM_WISHLIST', itemId)
        dispatch('saveWishlist')
    },
}
