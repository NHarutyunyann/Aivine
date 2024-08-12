<template>
    <div>
        <div class="product-category-filters sidebar-wrapper product-filter-dropdown">
            <div class="filter-box">
                <h5>Դասավորել ըստ</h5>
                <ul class="select-ul">
                    <li>
                        <a href="javascript:" :class="{active: $store.state.filters.orderBy === 'created_at'}" @click="applyFilters({orderBy: 'created_at'})">Նորից հին</a>
                    </li>
                    <li>
                        <a href="javascript:" :class="{active: $store.state.filters.orderBy === 'price'}" @click="applyFilters({orderBy: 'price'})">Գինը։ ցածրից բարձր</a>
                    </li>
                    <li>
                        <a href="javascript:" :class="{active: $store.state.filters.orderBy === 'price_desc'}" @click="applyFilters({orderBy: 'price_desc'})">Գինը։ բարձրից ցածր</a>
                    </li>
                </ul>
            </div>
<!--            <div class="filter-box" v-for="item in propAttributes">-->
<!--                <h5>{{ item.attribute.name }}</h5>-->
<!--                <ul class="checkbox-ul">-->
<!--                    <li v-for="option in item.options">-->
<!--                        <a-->
<!--                            @click="applyFilters({['filter_' + item.attribute.slug]: option.slug, page: 1})">-->
<!--                            <input type="checkbox" :checked="$store.state.filters['filter_' + item.attribute.slug]-->
<!--                               && $store.state.filters['filter_' + item.attribute.slug].split(',').includes(option.slug)">-->
<!--                            {{option.name}}-->
<!--                        </a>-->
<!--                        <span class="count">({{option.count}})</span>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
<!--        <div class="remove-filters mt-3" v-if="$store.getters.attrFilterKeys.length">-->
<!--            <a href="javascript:" @click="clearAttrFilters" rel="nofollow" class="remove-link">Մաքրել</a>-->
<!--            <ul>-->
<!--                <li v-for="(name, filter) in $store.getters.attrFilters" v-if="name">-->
<!--                    <a href="javascript:" @click="applyFilters({...{[filter]: null}, ...{page: 1}})" rel="nofollow">{{ name }}</a>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </div>-->
    </div>
</template>

<script>
import {mapActions} from "vuex"

export default {
    props: [
        'propAttributes'
    ],
    methods: {
        ...mapActions(['applyFilters']),
        clearAttrFilters() {
            const removeFilters = {}

            for(let i = 0; i < this.$store.getters.attrFilterKeys.length; i++) {
                removeFilters[this.$store.getters.attrFilterKeys[i]] = null;
            }

            this.applyFilters({...removeFilters, ...{page: 1}});
        }
    },
    data() {
      return {

      }
    },
    mounted() {
        jQuery('.filter-box h5').click(function () {
            if (jQuery(this).hasClass("active")) {
                jQuery(this).removeClass('active');
                jQuery(this).parent().find('ul').slideUp();
            }else {
                jQuery(this).addClass('active');
                jQuery(this).parent().find('ul').slideDown();
            }
        });
    }
}
</script>
