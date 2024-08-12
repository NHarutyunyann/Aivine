<template>
    <div class="input-group-sm">
        <label class="col-sm-12 col-form-label">{{ label || `Select ${(resource || '').replace('-', ' ')}`}}</label>
        <div class="col-sm-12 input-group-sm">
            <v-select
                :options="options"
                @search="fetchOptions"
                :label="optionLabel || 'title'"
                :searchable="true"
                multiple
                v-model="selectedData" />
            <input :name="`${field}[${key}]`" v-for="(item, key) in selectedData" type="hidden" :value="item.id" />
            <input :name="`${field}`" v-if="!selectedData || !selectedData.length" type="hidden" />
        </div>
    </div>
</template>
<script>
import vSelect from "vue-select"
import 'vue-select/dist/vue-select.css'
export default {
    props: ['optionList', 'optionLabel', 'selected', 'field', 'resource', 'label'],
    components: {'v-select': vSelect},
    data() {
        return {
            options: this.optionList || [],
            selectedData: this.selected || []
        }
    },
    methods: {
        fetchOptions(search) {
            if(this.resource) {
                axios.get(`/admin/${this.resource}/search?q=` + search).then(({data}) => {
                    this.options = data.items;
                })
            }
        },
    },
}
</script>
