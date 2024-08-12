export default (product) => {
    const regularPrice = isNaN(Number(product.regular_price)) ? null : Number(product.regular_price);
    const discountPrice = isNaN(Number(product.discount_price)) ? null : Number(product.discount_price);
    const minQuantity = product.calculated_min_quantity || product.min_quantity;
    const maxQuantity = isNaN(Number(product.max_quantity)) ? 0 : Number(product.max_quantity);
    const groupOf = product.calculated_group_of || product.group_of;

    let quantity = isNaN(Number(product.quantity)) || Number(product.quantity) <= 0 ? 1 : Number(product.quantity);

    quantity = quantity > product.stock ? product.stock : quantity;

    if(minQuantity && minQuantity > quantity) {
        quantity = minQuantity;
    }

    if(groupOf && groupOf > 1 && (quantity / groupOf) % 1 !== 0) {
        quantity = quantity - quantity % groupOf + groupOf
    }

    if(maxQuantity && maxQuantity < quantity) {
        quantity = maxQuantity
    }

    quantity = quantity > 99999 ? 99999 : quantity;

    return {
        id: product.id,
        item_id: product.item_id,
        title: product.title,
        sku: product.sku,
        categories: product.categories || [],
        image: product.image || (product.main_image && product?.main_image?.urls?.small),
        price: discountPrice || regularPrice,
        regular_price: regularPrice || 0,
        discount_price: discountPrice || 0,
        url: product.publish_url || product.url,
        weight: product.weight,
        stock: isNaN(Number(product.stock)) ? 0 : Number(product.stock),
        volume: product.volume,
        size: product.size,
        quantity,
        min_quantity: isNaN(Number(minQuantity)) ? 0 : Number(minQuantity),
        max_quantity: maxQuantity,
        group_of: isNaN(Number(groupOf)) ? 0 : Number(groupOf),
    }
}
