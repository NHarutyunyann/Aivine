export default {
    STORE_ACCOUNT_PAYMENTS (state, payload) {
       state.account.payments = payload || []
    },
    STORE_ACCOUNT_DEBT_PRICES (state, payload) {
        state.account.debt_prices = payload?.debt_prices || []
        state.account.total_debt = payload?.total_debt || null
    },
}
