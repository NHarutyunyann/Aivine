import helpers from "../helpers";
import cartActions from "./cart.actions";
import accountActions from "./account.actions";
import compareActions from "./compare.actions";
import wishlistActions from "./wishlist.actions";
import handleErrors from "../../services/handle-errors";

export default {
    ...cartActions,
    ...wishlistActions,
    ...compareActions,
    ...accountActions,
    ...{
        initCurrencyRates({ commit, state, dispatch }) {
            axios.get('/currency-rates').then(({data}) => {
                console.log('data', data)
                commit('SET_CURRENCY_RATES', data)
            }).catch(errors => {
                console.log('error: ', errors.response)
            });
        },
        setCurrency({ commit, state, dispatch }, curr = 'amd') {
            commit('SET_CURRENCY', curr)
        },
        async applyFilters ({ commit, state, dispatch }, query) {
            console.log('query: ', query)
            Object.keys(query).map(key => {
                if(state.filters[key] && key.indexOf('filter_') === 0) {
                    if(!query[key]) {
                        return;
                    }
                    const arr = [...[], ...state.filters[key].split(',')]

                    const index = arr.indexOf(query[key])
                    if(index !== -1) {
                        delete arr[index]
                        query[key] = arr.filter(i => i).join(',')
                    } else {
                        arr.push(query[key])
                        query[key] = arr.filter(i => i).join(',')
                    }
                }
            })

            commit('UPDATE_FILTERS', query)
            console.log('UPDATE_FILTERS', query)
            dispatch('loading')
            await helpers.renderProductList(query, state)
            document.querySelector(".main-content").scrollIntoView()
            dispatch('loading', false)
        },
        loading ({ commit, state }, isLoading) {
            commit('LOADING', isLoading)
        },
        storeLastSeenItem ({ commit, state }, item) {
            commit('STORE_LAST_SEEN_ITEM', item)
        },
        processCheckout ({ commit, state, dispatch, getters }) {
            dispatch('emptyNotes');
            commit('LOADING');
            return new Promise(resolve => {
                axios.post('/checkout/process', {...state.billing_info, ...{
                        cart: {...state.cart, ... {
                                total: getters.cartTotalPrice,
                                discount: getters.cartTotalDiscount,
                                discounted_total: getters.cartDiscountedTotalPrice
                            }
                        },
                }}).then(({data}) => {
                    commit('LOADING', false);
                    return resolve([null, data])
                }).catch(errors => {
                    console.log('error: ', errors.response)
                    commit('LOADING', false);
                    return resolve(handleErrors(errors, dispatch))
                });
            })
        },
        sendContactFormEmail ({ commit, state, dispatch, getters }, data) {
            dispatch('emptyNotes');
            commit('LOADING');
            return new Promise(resolve => {
                axios.post('/contact-form/send', data).then(({data}) => {
                    commit('LOADING', false);
                    return resolve([null, data])
                }).catch(errors => {
                    commit('LOADING', false);
                    return resolve(handleErrors(errors, dispatch))
                });
            })
        },
        sendProductReturnFormEmail ({ commit, state, dispatch, getters }, data) {
            dispatch('emptyNotes');
            commit('LOADING');
            return new Promise(resolve => {
                axios.post('/product-return-form/send', data, { headers: {'Content-Type': 'multipart/form-data'}}).then(({data}) => {
                    commit('LOADING', false);
                    return resolve([null, data])
                }).catch(errors => {
                    commit('LOADING', false);
                    return resolve(handleErrors(errors, dispatch))
                });
            })
        },
        sendPhoneRequest ({ commit, state, dispatch, getters }, data) {
            dispatch('emptyNotes');
            commit('LOADING');
            return new Promise(resolve => {
                axios.post('/phone-request/send', data).then(({data}) => {
                    commit('LOADING', false);
                    return resolve([null, true])
                }).catch(errors => {
                    commit('LOADING', false);
                    return resolve([null, true])
                });
            })
        },
        sendResumeFormEmail ({ commit, state, dispatch, getters }, data) {
            dispatch('emptyNotes');
            commit('LOADING');
            return new Promise(resolve => {
                axios.post('/resume-form/send', data, { headers: {'Content-Type': 'multipart/form-data'}}).then(({data}) => {
                    commit('LOADING', false);
                    return resolve([null, data])
                }).catch(errors => {
                    commit('LOADING', false);
                    return resolve(handleErrors(errors, dispatch))
                });
            })
        },
    },

    addNote ({ commit, state, getters }, payload) {
        if(typeof payload.scrollTo === 'undefined' || payload.scrollTo) {
            window.scrollTo(0, 0)
        }

        if(typeof payload === 'string') {
            commit('ADD_NOTIFICATION', {items: [{message: payload, type: 'success'}], target: null})
        } else {
            commit('ADD_NOTIFICATION', {items: typeof payload.item === 'undefined' ? payload.items : [payload.item], target: payload.target || null})
        }
    },
    emptyNotes ({ commit}) {
        commit('EMPTY_NOTIFICATIONS')
    },
}
