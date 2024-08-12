import handleErrors from "../../services/handle-errors";
let axiosSource  = null;
let axiosSaveCartSource  = null;

export default {
    loadCart ({ commit, state }) {
        axios.get(`/cart/load${state.cartHash ? '/' + state.cartHash : ''}`).then((response) => {
            commit('LOAD_CART', response.data.cart || {items: []})
            commit('STORE_CART_HASH', response.data.hash)
        });
    },
    saveCart ({ commit, state }, allowEmpty = false) {
        if(axiosSaveCartSource) {
            axiosSaveCartSource.cancel('Operation canceled by the user.');
        }

        axiosSaveCartSource = axios.CancelToken.source();
        axios.put(`/cart/save${state.cartHash ? '/' + state.cartHash : ''}`, {
            cart: {
                items: state.cart.items.map(item => ({
                    id: item.id,
                    title: item.title,
                    sku: item.sku,
                    image: item.image,
                    url: item.url,
                    size: item.size,
                    quantity: item.quantity || 1,
                }))
            },
            allowEmpty: allowEmpty
        }, { cancelToken: axiosSaveCartSource.token }).then((response) => {
                    commit('STORE_CART_HASH', response.data.hash)
                });
    },
    checkWeightLimit ({ state, getters, dispatch }) {
        if(!getters.auth || state.billing_info.delivery_type === 'self_transport') {
            return new Promise(resolve => {
                return resolve([null, true]);
            });
        }

        if(axiosSource) {
            axiosSource.cancel('Operation canceled by the user.');
        }

        axiosSource = axios.CancelToken.source();
        return new Promise(resolve => {
            axios.post('/is-weight-limit-right', {items: state.cart.items.map(item => ({
                    id: item.id,
                    quantity: item.quantity,
                }))}, { cancelToken: axiosSource.token }).then(({data}) => {
                return resolve([null, data.response]);
            }).catch((errors) => {
                return resolve([handleErrors(errors, dispatch, {scrollTo: false}), null]);
            });
        })
    },
    addToCart ({ commit, dispatch }, cartItem) {
        commit('ADD_TO_CART', cartItem)
        dispatch('saveCart')
    },
    updateCartQuantity ({ commit, dispatch }, payload) {
        commit('UPDATE_CART_QUANTITY', payload)
        dispatch('saveCart')
    },
    removeAllCartItems ({ commit, dispatch }) {
        commit('LOAD_CART', [])
        dispatch('saveCart', true)
    },
    removeFromCart ({ commit, dispatch }, itemId) {
        commit('REMOVE_FROM_CART', itemId)
        dispatch('saveCart', true)
    },
}
