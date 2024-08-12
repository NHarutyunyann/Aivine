export default (product) => {
    const price = isNaN(Number(product.regular_price)) ? 0 : Number(product.regular_price);
    const discount_price = isNaN(Number(product.discount_price)) ? 0 : Number(product.discount_price);

    return discount_price || price
}
