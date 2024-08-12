export default {
    addToCompare ({ commit, dispatch }, compareItem) {
        commit('ADD_TO_COMPARE', compareItem)
    },
    removeFromCompare ({ commit, dispatch }, itemId) {
        commit('REMOVE_FROM_COMPARE', itemId)
    }
}
