<template>
    <div class="search-box">
        <input type="text"
               v-model="search"
               @focusin="onSearchFocus"
               @focusout="onSearchFocusOut"
               @input="applyFilters"
               placeholder="Որոնել ապրանքներ" />
        <i class="icon-search-3" @click="onSearchSubmit"></i>
        <div class="header-search header-icon header-search-inline header-search-category w-lg-max mr-lg-4">
            <div class="search-result-box" ref="searchResultBox" style="display: none">
                <div class="search-result-product-box" v-if="result.length">
                    <a :href="item.publish_url" v-for="item in result" class="product-box" :key="`search_item_${item.id}`">
                        <div>
                            <div>
                                <img loading="lazy" :src="item?.main_image?.urls?.small" />
                            </div>
                            <h3>{{ item.title }}</h3>
                        </div>
                        <span>Կոդ։ {{ item.sku }}</span>
                        <h5>{{ priceFormatter(item.regular_price, $store.getters.currency, $store.getters.currencyRates) }}</h5>
                    </a>
                </div>
                <a href="javascript:" v-if="resultsNotFound" class="more-btn">Որոնման արդյունքում ապրանք չի գտնվել</a>

                <a :href="seeAllLink()" v-if="result.length" class="more-btn">Տեսնել բոլորը</a>
            </div>
        </div><!-- End .header-search -->
    </div>
</template>
<script>
import {mapActions} from "vuex";

export default {
    data() {
        return {
            search: '',
            category: null,
            result: [],
            resultsNotFound: false
        }
    },
    methods: {
        seeAllLink() {
            return this.category ? `${this.category.publish_url}?search=${this.search}` : `/shop?search=${this.search}`;
        },
        onSearchFocus() {
            this.$refs.searchResultBox.style.display = 'block'
        },
        onSearchFocusOut() {
            setTimeout(() => {
                this.$refs.searchResultBox.style.display = 'none'
            }, 300)
        },
        onSearchSubmit() {
            document.location.href = this.seeAllLink()
        },
        async applyFilters() {
            if(this.search) {
                const {data} = await axios.get(`/search-preview?search=${this.search}&cat_id=${this.category ? this.category.id : ''}`)
                this.result = data.items
            } else {
                this.result = []
            }

            this.resultsNotFound = !this.result.length
        }
    }
}
</script>
