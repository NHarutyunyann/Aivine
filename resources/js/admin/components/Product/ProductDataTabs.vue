<template>
    <div class="card card-default product-data-tabs main-card">
        <div class="card-header" data-card-widget="collapse">
            <div class="container">
                <div class="row">
                    <label class="col-6 col-form-label">Product Data</label>
                </div>
            </div>
        </div>
        <div class="card-body product-data-tabs-main-content">
            <div class="row">
                <div class="col-3">
                    <ul class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                         aria-orientation="vertical">
                        <li>
                           <a class="nav-link" href="javascript:" :class="{active: activeTab === 'general'}" data-toggle="pill" v-on:click="activeTab = 'general'">
                               <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"><path fill="currentColor" d="M16.68 9.77a4.543 4.543 0 0 1-4.95.99l-5.41 6.52c-.99.99-2.59.99-3.58 0s-.99-2.59 0-3.57l6.52-5.42c-.68-1.65-.35-3.61.99-4.95c1.28-1.28 3.12-1.62 4.72-1.06l-2.89 2.89l2.82 2.82l2.86-2.87c.53 1.58.18 3.39-1.08 4.65zM3.81 16.21c.4.39 1.04.39 1.43 0c.4-.4.4-1.04 0-1.43c-.39-.4-1.03-.4-1.43 0a1.02 1.02 0 0 0 0 1.43z"/></svg>
                                <span>General</span>
                           </a>
                        </li>
                        <li>
                            <a class="nav-link" href="javascript:" :class="{active: activeTab === 'linked_products'}" data-toggle="pill" v-on:click="activeTab = 'linked_products'">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"><path fill="currentColor" d="M16.68 9.77a4.543 4.543 0 0 1-4.95.99l-5.41 6.52c-.99.99-2.59.99-3.58 0s-.99-2.59 0-3.57l6.52-5.42c-.68-1.65-.35-3.61.99-4.95c1.28-1.28 3.12-1.62 4.72-1.06l-2.89 2.89l2.82 2.82l2.86-2.87c.53 1.58.18 3.39-1.08 4.65zM3.81 16.21c.4.39 1.04.39 1.43 0c.4-.4.4-1.04 0-1.43c-.39-.4-1.03-.4-1.43 0a1.02 1.02 0 0 0 0 1.43z"/></svg>
                                <span>Linked Products</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="javascript:" :class="{active: activeTab === 'product_visibility'}" data-toggle="pill" v-on:click="activeTab = 'product_visibility'">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"><path fill="currentColor" d="M16.68 9.77a4.543 4.543 0 0 1-4.95.99l-5.41 6.52c-.99.99-2.59.99-3.58 0s-.99-2.59 0-3.57l6.52-5.42c-.68-1.65-.35-3.61.99-4.95c1.28-1.28 3.12-1.62 4.72-1.06l-2.89 2.89l2.82 2.82l2.86-2.87c.53 1.58.18 3.39-1.08 4.65zM3.81 16.21c.4.39 1.04.39 1.43 0c.4-.4.4-1.04 0-1.43c-.39-.4-1.03-.4-1.43 0a1.02 1.02 0 0 0 0 1.43z"/></svg>
                                <span>Product Visibility</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="javascript:" :class="{active: activeTab === 'attributes'}" data-toggle="pill" v-on:click="activeTab = 'attributes'">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"><path fill="currentColor" d="M3 5h14V3H3v2zm0 4h3V7H3v2zm14 4V7H8v6h9zM3 13h3v-2H3v2zm0 4h14v-2H3v2z"/></svg>
                                <span>Attributes</span>
                            </a>
                        </li>
                        <li>
                            <a class="nav-link" href="javascript:" :class="{active: activeTab === 'sizes'}" data-toggle="pill" v-on:click="activeTab = 'sizes'">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" role="img" width="1em" height="1em" preserveAspectRatio="xMidYMid meet" viewBox="0 0 20 20"><path fill="currentColor" d="M16.68 9.77a4.543 4.543 0 0 1-4.95.99l-5.41 6.52c-.99.99-2.59.99-3.58 0s-.99-2.59 0-3.57l6.52-5.42c-.68-1.65-.35-3.61.99-4.95c1.28-1.28 3.12-1.62 4.72-1.06l-2.89 2.89l2.82 2.82l2.86-2.87c.53 1.58.18 3.39-1.08 4.65zM3.81 16.21c.4.39 1.04.39 1.43 0c.4-.4.4-1.04 0-1.43c-.39-.4-1.03-.4-1.43 0a1.02 1.02 0 0 0 0 1.43z"/></svg>
                                <span>Sizes</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-9 pl-0">
                    <div class="tab-content" id="vert-tabs-tabContent">
                        <div class="tab-pane fade" :class="{'show active': activeTab === 'general'}">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Regular Price</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input
                                        type="number"
                                        step="any"
                                        v-model="selectedData.regular_price"
                                        name="regular_price"
                                        class="form-control"
                                        :class="{'is-invalid': errors.regular_price}">
                                    <span v-if="errors.regular_price" class="invalid-feedback">{{ errors.regular_price }}</span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Sale Price</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input
                                        type="number"
                                        step="any"
                                        v-model="selectedData.sale_price"
                                        name="sale_price"
                                        class="form-control"
                                        :class="{'is-invalid': errors.sale_price}">
                                    <span v-if="errors.sale_price" class="invalid-feedback">{{ errors.sale_price }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Position</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input
                                        type="text"
                                        step="any"
                                        v-model="selectedData.position"
                                        name="position"
                                        class="form-control"
                                        :class="{'is-invalid': errors.position}">
                                    <span v-if="errors.position" class="invalid-feedback">{{ errors.position }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">SKU</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input
                                        type="text"
                                        v-model="selectedData.sku"
                                        name="sku"
                                        class="form-control"
                                        :class="{'is-invalid': errors.sku}">
                                    <span v-if="errors.sku" class="invalid-feedback">{{ errors.sku }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Stock</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input
                                        type="text"
                                        v-model="selectedData.stock"
                                        name="stock"
                                        class="form-control"
                                        :class="{'is-invalid': errors.stock}">
                                    <span v-if="errors.stock" class="invalid-feedback">{{ errors.stock }}</span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Stock status</label>
                                <div class="col-sm-5 input-group-sm">
                                    <select
                                        v-model="selectedData.stock_status"
                                        name="stock_status"
                                        class="form-control custom-select"
                                        :class="{'is-invalid': errors.stock_status}">
                                            <option value="in_stock">In Stock</option>
                                            <option value="out_of_stock">Out of stock</option>
                                    </select>
                                    <span v-if="errors.stock_status" class="invalid-feedback">{{ errors.stock_status }}</span>
                                </div>
                            </div>

                            <!-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Minimum quantity</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input
                                        type="number"
                                        step="1"
                                        v-model="selectedData.min_quantity"
                                        name="min_quantity"
                                        class="form-control"
                                        :class="{'is-invalid': errors.min_quantity}">
                                    <span v-if="errors.min_quantity" class="invalid-feedback">{{ errors.min_quantity }}</span>
                                </div>
                            </div> -->

                            <!-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Maximum quantity</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input type="number"
                                           step="1"
                                           v-model="selectedData.max_quantity"
                                           name="max_quantity"
                                           class="form-control"
                                           :class="{'is-invalid': errors.max_quantity}">
                                    <span v-if="errors.max_quantity" class="invalid-feedback">{{ errors.max_quantity }}</span>
                                </div>
                            </div> -->

                            <!-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Group Of</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input type="number"
                                           step="1"
                                           v-model="selectedData.group_of"
                                           name="group_of"
                                           class="form-control"
                                           :class="{'is-invalid': errors.group_of}">
                                    <span v-if="errors.group_of" class="invalid-feedback">{{ errors.group_of }}</span>
                                </div>
                            </div> -->
                        </div>

                        <div class="tab-pane fade" :class="{'show active': activeTab === 'linked_products'}">
                            <div class="row">
                                <div class="col-12">
                                    <multi-select
                                        field="relations[upsell_products]"
                                        label="Upsell products"
                                        :selected="selectedData.upsell_products"
                                        resource="products"></multi-select>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" :class="{'show active': activeTab === 'product_visibility'}">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Visible</label>
                                <div class="col-sm-5 input-group-sm">
                                    <v-select
                                        :options="groups"
                                        label="display_name"
                                        :searchable="true"
                                        multiple
                                        v-model="selectedData.visible_groups" />
                                    <input :name="`relations[visible_groups][${item.id}][type]`" v-for="item in selectedData.visible_groups" type="hidden" value="visible" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <multi-select
                                        field="relations[visible_users]"
                                        label="Visible By User"
                                        :selected="selectedData.visible_users"
                                        option-label="email"
                                        resource="users">
                                    </multi-select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Invisible</label>
                                <div class="col-sm-5 input-group-sm">
                                    <v-select
                                        :options="groups"
                                        label="display_name"
                                        :searchable="true"
                                        multiple
                                        v-model="selectedData.invisible_groups" />
                                    <input :name="`relations[invisible_groups][${item.id}][type]`" v-for="item in selectedData.invisible_groups" type="hidden" value="invisible" />
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane attributes-tab fade" :class="{'show active': activeTab === 'attributes'}">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group input-group-sm">
                                        <select class="form-control custom-select mr-3" v-model="addAttributeItem">
                                            <option v-for="attribute in attributes" :value="attribute">{{ attribute.name }}</option>
                                        </select>
                                        <span class="input-group-append">
                                            <button type="button" class="btn-primary" v-on:click="addAttributeRow">Add</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                               <div class="col">

                                   <div class="card card-default collapsed-card main-card" v-for="(selectedAttribute, key) in selectedData.attributes">
                                       <div class="card-header" data-card-widget="collapse">
                                           <div class="row pl-3">
                                               {{attributesGrouped[selectedAttribute.id].name}}
                                           </div>
                                           <div class="card-tools">
                                               <a href="javascript:" class="remove" v-on:click="removeAttribute(key)">Remove</a>
                                           </div>
                                       </div>
                                       <div class="card-body">
                                           <div class="row align-items-center">
                                               <input :name="`relations[attributes][${key}][id]`" type="hidden" :value="selectedAttribute.id" />
                                               <input :name="`relations[attributes][${key}][option_ids][${optKey}]`" v-for="(optionId, optKey) in selectedAttribute.option_ids" type="hidden" :value="optionId" />
                                               <div class="col-9">
                                                   <v-select
                                                       :options="Object.values(attributesGrouped[selectedAttribute.id].options)"
                                                       :reduce="option => option.id"
                                                       label="name"
                                                       :searchable="true"
                                                       multiple
                                                       v-model="selectedAttribute.option_ids"
                                                   />
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" :class="{'show active': activeTab === 'sizes'}">
                            <div class="form-group row">
                            <product-sizes  :prop-sizes="this.propSizes" :prop-size="this.propSize"></product-sizes>
                                
                                <!-- <label class="col-sm-3 col-form-label">Weight(kg)</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input
                                        type="text"
                                        v-model="selectedData.weight"
                                        name="weight"
                                        class="form-control"
                                        :class="{'is-invalid': errors.weight}">
                                    <span v-if="errors.weight" class="invalid-feedback">{{ errors.weight }}</span>
                                </div> -->
                            <!-- </div> -->
                            <!-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Volume(m<sup>3</sup>)</label>
                                <div class="col-sm-5 input-group-sm">
                                    <input
                                        type="text"
                                        v-model="selectedData.volume"
                                        name="volume"
                                        class="form-control"
                                        :class="{'is-invalid': errors.volume}">
                                    <span v-if="errors.volume" class="invalid-feedback">{{ errors.volume }}</span>
                                </div>-->
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import vSelect from "vue-select"
import 'vue-select/dist/vue-select.css'
import MediaUploader from "../MediaUploader";
export default {
    name: 'product-data-tabs',
    props: ['propAttributes', 'propErrors', 'propSelectedData', 'propGroups', 'propUsers','propSizes','propSize'],
    components: {MediaUploader, 'v-select': vSelect},
    data() {
        return {
            attributes: this.propAttributes,
            groups: this.propGroups,
            users: this.propUsers,
            activeTab: 'general',
            addAttributeItem: null,

            selectedData: {
                attributes: (this.propSelectedData.relations && this.propSelectedData.relations.attributes) || [],
                id: this.propSelectedData.id || null,
                regular_price: this.propSelectedData.regular_price || null,
                type: this.propSelectedData.type || 'simple',
                sale_price: this.propSelectedData.sale_price || null,
                position: this.propSelectedData.position || 0,
                sku: this.propSelectedData.sku || null,
                stock: this.propSelectedData.stock || 0,
                stock_status: this.propSelectedData.stock_status || 'in_stock',
                weight: this.propSelectedData.weight || null,
                volume: this.propSelectedData.volume || null,
                max_quantity: this.propSelectedData.max_quantity || null,
                min_quantity: this.propSelectedData.min_quantity || null,
                group_of: this.propSelectedData.group_of || null,
                upsell_products: (this.propSelectedData.relations && this.propSelectedData.relations.upsell_products) || [],
                visible_groups: (this.propSelectedData.relations && this.propSelectedData.relations.visible_groups) || [],
                visible_users: (this.propSelectedData.relations && this.propSelectedData.relations.visible_users) || [],
                invisible_groups: (this.propSelectedData.relations && this.propSelectedData.relations.invisible_groups) || [],
            },
            errors: this.propErrors || {},
        }
    },
    computed: {
        attributesGrouped() {
            const grouped = {}
            for(let i = 0; i < this.attributes.length; i++) {
                grouped[this.attributes[i].id] = {...{}, ...this.attributes[i]}
                grouped[this.attributes[i].id].options = {}

                for(let j = 0; j < this.attributes[i].options.length; j++) {
                    grouped[this.attributes[i].id].options[this.attributes[i].options[j].id] = this.attributes[i].options[j]
                }
            }

            return grouped
        },
    },
    methods: {
        addAttributeRow() {
            if(this.addAttributeItem && !this.selectedData.attributes.find(i => i.id === this.addAttributeItem.id)){
                this.selectedData.attributes.push({
                    id: this.addAttributeItem.id,
                    option_ids: []
                })
            }
        },
        removeAttribute(index) {
            this.selectedData.attributes.splice( index, 1)
        },
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
