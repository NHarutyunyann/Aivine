<template>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <multi-select
                    field="products"
                    :selected="selectedData.products"
                    resource="products"></multi-select>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <multi-select
                    field="categories"
                    option-label="name"
                    :selected="selectedData.categories"
                    resource="categories"></multi-select>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props: ['propErrors', 'propSelectedData'],
    data() {

        return {
            selectedData: {
                products: this.propSelectedData.products || [],
                categories: this.propSelectedData.categories || [],
            },
            errors: this.propErrors || {},
        }
    }
}
</script>
<style scoped>
.card-body {
    /*min-height: 500px;*/
}
.product-data-tabs .card-body label{
    font-size: 14px;
}

.product-data-tabs .custom-accordion .card-tools {
    position: absolute;
    right: 17px;
    top: 13px;
}
.product-data-tabs .custom-accordion .variants-container {
    padding-right: 20px;
}

.remove-item-btn {
    color: #ff0000;
    font-size: 14px;
}
.remove-item-btn:hover {
    text-decoration: underline;
}

.card-header {
    cursor: pointer;
}

</style>
