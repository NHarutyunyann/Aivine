<template>
    <div>
        <ul class="pagination toolbox-item" v-if="totalPages > 1">
            <li class="page-item" v-if="currentPage !== 1">
                <a class="page-link page-link-btn" tabindex @click="hasOnPageChangeListener ? $emit('onPageChange', {page: currentPage - 1}) : applyFilters({page: currentPage - 1})">
                    <i class="icon-angle-left"></i>
                </a>
            </li>
            <li v-for="page in totalPages" :key="page" v-bind:class="{ active: currentPage === page }" class="page-item" v-if="page <= pagesShowLength">
                <a class="page-link" tabindex @click="hasOnPageChangeListener ? $emit('onPageChange', {page}) : applyFilters({page})">{{ page }}</a>
            </li>
            <li class="page-item" v-if="totalPages > 10 && currentPage > pagesShowLength && currentPage < (totalPages - pagesShowLength)"><span class="page-link">...</span></li>

            <li v-for="page in totalPages" :key="page" v-bind:class="{ active: currentPage === page }" class="page-item"
                v-if="page > pagesShowLength && page <= (totalPages - 4) && Math.abs(currentPage - page) <= 2">
                <a class="page-link" tabindex @click="hasOnPageChangeListener ? $emit('onPageChange', {page}) : applyFilters({page})">{{ page }}</a>
            </li>

            <li class="page-item" v-if="totalPages > 10 && currentPage > pagesShowLength && currentPage < (totalPages - pagesShowLength)"><span class="page-link">...</span></li>

            <li v-for="page in totalPages" :key="page" v-bind:class="{ active: currentPage === page }" class="page-item" v-if="page > (totalPages - 4) && page > pagesShowLength">
                <a class="page-link" tabindex @click="hasOnPageChangeListener ? $emit('onPageChange', {page}) : applyFilters({page})">{{ page }}</a>
            </li>
            <li class="page-item" v-if="totalPages !== currentPage">
                <a class="page-link page-link-btn" tabindex @click="hasOnPageChangeListener ? $emit('onPageChange', {page: currentPage + 1}) : applyFilters({page: currentPage + 1})">
                    <i class="icon-angle-right"></i>
                </a>
            </li>
        </ul>
    </div>
</template>

<script>
import {mapActions} from 'vuex'
export default {
    props: ['total', 'perPage', 'page'],
    data() {
        return {
            pagesShowLength: 4,
        }
    },

    methods: {
        ...mapActions(['applyFilters']),
    },
    computed: {
        totalPages() {
            return Math.ceil(this.total / (this.perPage || this.$store.state.filters.perPage));
        },
        currentPage() {
            return this.page || this.$store.state.filters.page;
        },
        hasOnPageChangeListener(){
            return this.$listeners && this.$listeners.onPageChange
        }
    }
}
</script>
