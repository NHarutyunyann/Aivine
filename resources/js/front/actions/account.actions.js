import mapCartItem from "../../services/map-cart-item";
import handleErrors from "../../services/handle-errors";

export default {
    getPayedPrices ({ commit }) {
        commit('LOADING')
        axios.get('/my-account/get-payed-prices').then(({data}) => {
            commit('STORE_ACCOUNT_PAYMENTS', data.items)
            commit('LOADING', false)
        }).catch(e => {
            console.error('error:', e.message)
            commit('LOADING', false)
        });
    },
    getProductReturnFiles ({ commit }, {page, perPage}) {
        return new Promise(resolve => {
            commit('LOADING')
            axios.get(`/my-account/get-product-return-files?page=${page}&perPage=${perPage}`).then(({data}) => {
                commit('LOADING', false)
                return resolve(data);
            }).catch(e => {
                console.error('error:', e.message)
                commit('LOADING', false)
                return resolve({total: 0, items: []});
            });
        })
    },
    getDebtPrices ({ commit, dispatch }) {
        commit('LOADING')
        axios.get('/my-account/get-debt-prices').then(({data}) => {
            
            if(data.is_late) {
                dispatch('addNote', {item: {message: 'Դուք ունեք ժամկետանց պարտք և չեք կարող գնումներ կատարել կայքից։<a href="/kap" class="link">կապվել մեզ հետ</a>', type: 'error'}})
            }
            commit('STORE_ACCOUNT_DEBT_PRICES', data)
            commit('LOADING', false)
        }).catch(e => {
            console.error('error:', e.message)
            commit('LOADING', false)
        });
    },
    handleOrderAgain ({ commit, dispatch }, orderId) {
        dispatch('emptyNotes');
        commit('LOADING')
        axios.get(`/my-account/order-again/${orderId}`).then(({data}) => {
            const {items, errors} = data;
            for(let i = 0; i < items.length; i++) {
                commit('ADD_TO_CART', mapCartItem({...items[i].product, ...{quantity: items[i].quantity}}))
            }

            dispatch('saveCart').then(() => {
                dispatch('addNote', {item: {message: 'Ապրանքները ավելացված են զամբյուղ', type: 'success', flash: true}})
                dispatch('addNote', {items: errors.map(i => ({message: i, type: 'error', flash: true}))})
                location.href = '/cart';
            })
            commit('LOADING', false)
        }).catch(e => {
            console.error('error:', e.message)
            commit('LOADING', false)
        });
    },
    handleFastOrder ({ commit, dispatch }, payload) {
        return new Promise(resolve => {
            commit('LOADING');
            axios.post('/my-account/fast-order', payload).then(async ({data}) => {
                const {items, errors} = data;
                for(let i = 0; i < items.length; i++) {
                    commit('ADD_TO_CART', mapCartItem({...items[i].product, ...{quantity: items[i].quantity}}))
                }

                await dispatch('saveCart').then(() => {
                    dispatch('addNote', {item: {message: 'Ապրանքները ավելացված են զամբյուղ', type: 'success', flash: true}})
                    dispatch('addNote', {items: errors.map(i => ({message: i, type: 'error', flash: true}))})
                    location.href = '/cart';
                })
                commit('LOADING', false)

                return resolve([null, data.response]);
            }).catch((errors) => {
                commit('LOADING', false);
                return resolve([handleErrors(errors, dispatch), null]);
            });
        })
    },
}
