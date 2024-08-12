export default {
    compareTotalCount: state => {
        return state.compare_items.length
    },
    compareItems: state => {
        return state.compare_items || []
    },
}
