
export default {
    cartTotalCount: (state, getters) => {
        return getters.cartItems.reduce((a, b) => a + (Number(b.quantity) || 0), 0)
    },
    cartTotalPrice: (state, getters) => {
        return getters.cartItems.reduce((a, b) => a + ((Number(b.regular_price) * Number(b.quantity)) || 0), 0)
    },
    cartDiscountedTotalPrice: (state, getters) => {
        return getters.cartItems.reduce((a, b) => a + ((Number(b.price) * Number(b.quantity)) || 0), 0)
    },
    cartTotalDiscount: (state, getters) => {
        return getters.cartTotalPrice - getters.cartDiscountedTotalPrice
    },
    cartItems: state => {
        return state.cart.items || []
    },
    cartItemsGroupedByCategory: state => {
        const grouped = {};

        for(let i = 0; i < (state.cart.items || []).length; i++ ) {
            const item = state.cart.items[i];

            const category = [
                item?.categories?.[0],
                item?.categories?.[0]?.parent,
                item?.categories?.[0]?.parent?.parent,
                item?.categories?.[0]?.parent?.parent?.parent,
            ].reverse().filter(c => c)[0];

            if(!grouped[category?.slug || 'uncategorized']) {
                grouped[category?.slug || 'uncategorized'] = {items: [], category: category, total_price: 0, discounted_total_price: 0, total_discount: 0};
            }

            grouped[category?.slug || 'uncategorized'].items.push(item);
        }

        const groupedArr = Object.keys(grouped)
        for(let i = 0; i < groupedArr.length; i++ ) {
            const cat = groupedArr[i];

            grouped[cat].total_price = grouped[cat].items.reduce((a, b) => a + ((Number(b.regular_price) * Number(b.quantity)) || 0), 0);
            grouped[cat].discounted_total_price = grouped[cat].items.reduce((a, b) => a + ((Number(b.price) * Number(b.quantity)) || 0), 0);
            grouped[cat].total_discount = grouped[cat].total_price - grouped[cat].discounted_total_price;
        }

        return grouped
    },
    cartLoaded: state => {
        return !!state.app.cartLoaded
    },
    cartTotalWeightAndVolume: (state, getters) => {
        return {
            weight: getters.cartItems.reduce((a, b) => a + ((Number(b.weight) * Number(b.quantity)) || 0), 0),
            volume: getters.cartItems.reduce((a, b) => a + ((Number(b.volume) * Number(b.quantity)) || 0), 0),
        }
    }
}
