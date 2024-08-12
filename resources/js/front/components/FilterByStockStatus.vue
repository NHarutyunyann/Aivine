<template>
    <div class="filter-by-stock-status-box">
        <div class="radio-buttons d-flex">
            <div class="input-group radio-btn-box custom-radio-btn">
                <label class="radio-btn-label">
                    <input type="radio" class="radio-input" name="stockStatus" :checked="propSelected === 'in_stock'" @change="applyFilters({stock_status: 'in_stock'})" />
                    <span class="radio-icon"></span>
                    <span class="label-text">Առկա <span class="hide-mobile">ապրանքներ</span></span>
                </label>
            </div>
            <div class="input-group radio-btn-box custom-radio-btn">
                <label class="radio-btn-label">
                    <input type="radio" class="radio-input" name="stockStatus" :checked="!propSelected || propSelected === 'all'" @change="applyFilters({stock_status: 'all'})" />
                    <span class="radio-icon"></span>
                    <span class="label-text">Բոլորը</span>
                </label>
            </div>
        </div>
    </div>
</template>

<script>

import {mapActions} from "vuex";

export default {
    props: ['propSelected'],
    methods: {
        ...mapActions(['applyFilters']),
    },
}
</script>
