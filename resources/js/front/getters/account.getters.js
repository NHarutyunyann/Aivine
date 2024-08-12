
export default {
    accountPayments: state => {
        return state.account.payments
    },
    accountDebtPrices: state => {
        return state.account.debt_prices || []
    },
    totalDebt: state => {
        return state.account.total_debt
    },
    totalLateDebt: (state, getters) => {
        return getters.accountDebtPrices.reduce((a, b) => a + (b.is_late ? (isNaN(b.sum) ? 0 : Number(b.sum)) : 0), 0);
    },
}
