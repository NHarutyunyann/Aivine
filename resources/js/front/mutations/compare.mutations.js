export default {
    ADD_TO_COMPARE (state, payload) {
        const index = state.compare_items.findIndex(i => i.id === payload.id)

        if(!state.compare_items[index]) {
            state.compare_items.push(payload)
        }
    },
    REMOVE_FROM_COMPARE (state, payload) {
        const index = state.compare_items.findIndex(i => i.id === payload)
        if(index !== -1) {
            state.compare_items.splice(index, 1)
        }
    },
}
