export default {
    wishlistTotalCount: state => {
        return state.wishlist.items.length
    },
    wishlistItems: state => {
        return state.wishlist.items || []
    },
    wishlistHash: state => {
        return state.wishlist.hash || null
    }
}
