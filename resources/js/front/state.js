const queryParams = (new URL(document.location.href)).searchParams

const attributes = {}
queryParams.forEach(function(value, key) {
    if(key.indexOf('filter_') === 0) {
        attributes[key] = value
    }
});

export default () => ({
    app: {
        loading: false,
        cartLoaded: false,
        auth: null,
        zoomProduct: null,
        currencyRates: null
    },
    currency: 'amd',
    notifications: {
        target: null,
        items: [],
    },
    cart: {
        items: [],
    },
    cartHash: null,
    wishlist: {
        items: [],
    },
    account: {
      payments: [],
      debt_prices: [],
      total_debt: null,
    },
    wishlistHash: null,
    compare_items: [],
    last_seen_items: [],
    billing_info: {
        payment_type: 'bank_transfer',
        first_name: null,
        last_name: null,
        company_name: null,
        address: null,
        city: null,
        phone_number: null,
        additional_info: null,
        delivery_type: 'deliver',
    },
    filters: {...{
            orderBy: queryParams.get('orderBy') || '',
            perPage: Number(queryParams.get('perPage')) || 24,
            page: Number(queryParams.get('page')) || 1,
            search: queryParams.get('search') || null
        }, ...attributes},
})
