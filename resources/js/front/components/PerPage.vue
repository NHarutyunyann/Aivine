<template>
    <div class="toolbox-item toolbox-show perpage-filter">
       <div class="select-box">
           <label>Ցույց տալ</label>
           <div class="select-custom">
               <select name="count" @change="applyFilters({perPage: $store.state.filters.perPage, page: 1})" class="form-control" v-model="$store.state.filters.perPage">
                   <option value="12">12</option>
                   <option value="24">24</option>
                   <option value="48">48</option>
                   <option value="96">96</option>
               </select>
           </div><!-- End .select-custom -->
       </div>
    </div><!-- End .toolbox-item -->
</template>

<script>
import {mapActions} from 'vuex'

export default {
    methods: {
        ...mapActions(['applyFilters']),
    }
}
</script>
