export default (data, curr = 'amd', currencyRates) => {
    let price = data
    let maximumFractionDigits = 0
    if (currencyRates && curr !== 'amd' && currencyRates[curr]) {
        price = price / currencyRates[curr]
        if (curr === 'rub') {
            price = Math.ceil(price)
        }
        maximumFractionDigits = 2
    }
    let formatter = new Intl.NumberFormat('am-AM', {maximumFractionDigits: maximumFractionDigits});
    price = formatter.format(price)

    switch (curr) {
        case "amd": return `${price} ֏`
        case "usd": return `${price} $`
        case "rub": return `${price} ₽`
    }
}
