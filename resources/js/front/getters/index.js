import cartGetters from './cart.getters'
import accountGetters from './account.getters'
import wishlistGetters from './wishlist.getters'
import compareGetters from './compare.getters'

export default {
    ...cartGetters,
    ...wishlistGetters,
    ...compareGetters,
    ...accountGetters,
    ...{
        //TODO: APP
        currency: state => {
            return state.currency
        },
        currencyRates: state => {
            return state.app.currencyRates
        },
        loading: state => {
            return state.app.loading
        },
        auth: state => {
            return state.app.auth
        },
        isAdmin: state => {
            return state.app.auth && state.app.auth.isAdmin
        },
        isSuperAdmin: state => {
            return state.app.auth && state.app.auth.isSuperAdmin
        },
        //TODO: CHECKOUT
        billingInfo: state => {
            return state.billing_info
        },
        notifications: state => {
            return state.notifications || {}
        },
        lastSeenItems: state => {
            return state.last_seen_items || []
        },
        attrFilters: state => {
            const filters = {}
            const filterKeys = Object.keys(state.filters);
            for(let i = 0; i < filterKeys.length; i++) {
                if(filterKeys[i].indexOf('filter_') === 0) {
                    filters[filterKeys[i]] = state.filters[filterKeys[i]];
                }
            }
            return filters
        },
        attrFilterKeys: state => {
            const filters = []
            const filterKeys = Object.keys(state.filters);
            for(let i = 0; i < filterKeys.length; i++) {
                if(filterKeys[i].indexOf('filter_') === 0 && state.filters[filterKeys[i]]) {
                    filters.push(filterKeys[i]);
                }
            }
            return filters
        }
    }
}
