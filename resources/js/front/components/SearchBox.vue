<template>
    <div class="header-search header-icon header-search-inline header-search-category w-lg-max">
        <form @submit.stop.prevent="onSearchSubmit" method="get">
            <div class="header-search-wrapper">
                <div class="search-div">
                    <img class="search-loop" alt="loop" src="/images/icons/searchloop.svg">
                    <input type="search" v-model="search"
                           @focusin="onSearchFocus"
                           @focusout="onSearchFocusOut"
                           @input="applyFilters"
                           autocomplete="off"
                           class="form-control" name="search" id="search" placeholder="Փնտրեք ըստ կոդի, անվանման, մոդելի...">
                </div>

<!--                <div class="header-search-select">-->
<!--                    <a href="javascript:">{{ category ? category.name : 'Ընտրել ապրանքատեսակը' }}</a>-->
<!--                    <ul ref="categorySelectBox">-->
<!--                        <li v-for="cat in categories">-->
<!--                            <a href="javascript:" @click="category = cat;applyFilters()">{{ cat.name }}</a>-->
<!--                            <ul v-if="cat.sub_categories" v-for="sub in cat.sub_categories">-->
<!--                                <li>-->
<!--                                    <a href="javascript:" @click="onCategorySelect(sub)">{{ sub.name }}</a>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </div>-->
                <button class="icon-search-3 search-header" type="submit"> <span class="button-ser">Փնտրել</span> <img class="button-img" src="/images/icons/mobile-search1.svg" alt="img"></button>

                <div class="search-result-box" ref="searchResultBox" style="display: none">
                    <div class="search-result-product-box" v-if="result.length">
                        <a :href="item.publish_url" v-for="item in result" class="product-box" :key="`sh_r_i_${item.id}`">
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
            </div><!-- End .header-search-wrapper -->
        </form>
    </div><!-- End .header-search -->
</template>
<script>
import {mapActions} from "vuex";

export default {
    data() {
        return {
            search: '',
            category: null,
            categories: [],
            result: [],
            resultsNotFound: false
        }
    },
    mounted() {
      this.getCategories()
    },
    methods: {
        async getCategories() {
            const {data} = await axios.get('/categories/list')
            this.categories = data.items
        },
        seeAllLink() {
            return this.category ? `${this.category.publish_url}?search=${this.search}` : `/shop?search=${this.search}`;
        },
        onSearchFocus() {
            this.$refs.searchResultBox.style.display = 'block'
        },
        onCategorySelect(sub) {
            this.$refs.searchResultBox.style.display = 'block'
            this.category = sub;
            this.$refs.categorySelectBox.style.display = 'none'

            this.applyFilters()
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
