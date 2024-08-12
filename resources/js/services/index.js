import slugify from "./slugify";
import mapCartItem from "./map-cart-item";
import priceFormatter from "./price-formatter";
import textFormatter from "./text-formatter";
import decimalFormatter from "./decimal-formatters";
import capitalize from "./capitalize";
import calculatePrice from "./calculate-price";
import handleErrors from "./handle-errors";

export default {
    calculatePrice,
    slugify,
    mapCartItem,
    priceFormatter,
    textFormatter,
    decimalFormatter,
    handleErrors,
    capitalize,
}
