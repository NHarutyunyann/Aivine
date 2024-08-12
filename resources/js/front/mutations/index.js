import cartMutations from './cart.mutations';
import wishlistMutations from './wishlist.mutations';
import accountMutations from './account.mutations';
import compareMutations from './compare.mutations';
export default {
    ...cartMutations,
    ...wishlistMutations,
    ...compareMutations,
    ...accountMutations,
    ...{
        SET_CURRENCY_RATES (state, payload) {
            state.app.currencyRates = payload
        },
        SET_CURRENCY (state, payload) {
            state.currency = payload
        },
        LOADING (state, payload = true) {
            state.app.loading = payload
        },
        UPDATE_FILTERS (state, payload) {
            console.log('UPDATE_FILTERS: ', state, payload)
            state.filters = {...state.filters, ...payload}
        },
        INSERT_AUTH (state, payload) {
            if(payload && payload.id) {
                state.app.auth = payload
            }
        },
        INSERT_INITIAL_DATA (state, payload) {
            console.log('INSERT_INITIAL_DATA: ', payload)

            if(payload) {
                let keys = Object.keys(payload)
                for(let i = 0; i < keys.length; i++) {
                    if(keys[i].split('.')[1]) {
                        if(state[keys[i].split('.')[0]] !== undefined && state[keys[i].split('.')[0]][keys[i].split('.')[1]] !== undefined) {
                            state[keys[i].split('.')[0]][keys[i].split('.')[1]] = payload[keys[i]]
                        }
                    } else {
                        if(state[keys[i]] !== undefined) {
                            if(typeof payload[keys[i]] === 'object') {
                                state[keys[i]] = {...state[keys[i]], ...payload[keys[i]]}
                            } else {
                                state[keys[i]] = payload[keys[i]]
                            }
                        }
                    }
                }
            }

            state.notifications.target = null;
            state.notifications.items = state.notifications.items.filter(i => i.flash).map(i => ({...i, ...{ flash: false }}));

        },
        STORE_LAST_SEEN_ITEM (state, payload) {
            const index = state.last_seen_items.findIndex(i => i.id === payload.id)
            if(index !== -1) {
                state.last_seen_items.splice(index, 1)
            }

            state.last_seen_items.unshift({
                id: payload.id,
                publish_url: payload.url,
                image: payload.image,
                title: payload.title,
                regular_price: payload.regular_price,
                discount_price: payload.discount_price,
            });
            state.last_seen_items = state.last_seen_items.slice(0, 5)
        },
        ADD_NOTIFICATION (state, payload) {
            state.notifications.items = state.notifications.items.concat(payload.items)
            state.notifications.target = payload.target
        },
        EMPTY_NOTIFICATIONS (state) {
            state.notifications.items = []
        },
        OPEN_PRODUCT_ZOOM (state, payload) {
            state.app.zoomProduct = payload
        }
    }
}
