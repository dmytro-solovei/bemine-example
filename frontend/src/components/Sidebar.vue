<template>
    <div class="wrapper-sidebar">
        <div class="widget woof_Widget sidebar-filters_wrap">
            <div class="widget widget-categories sidebar-filter" v-if="categories.length">
                <h3 class="widgettitle">{{ $t('selectType') }}</h3>
                <ul class="list-categories">
                    <li v-for="cat in categories" :key="cat.id">
                        <Checkbox
                            id="category"
                            :label="categoryName(cat.name)"
                            :input-value="cat.id"
                            v-model="selectedCategories"
                            @change.native="getCategoryBrandsAndSizes"
                            class="checkbox-color"
                        />
                    </li>
                </ul>
            </div>
            <div class="widget widget_filter_price sidebar-filter" v-if="price">
                <h4 class="widgettitle">
                    {{ $t('selectPrice') }}
                </h4>
                <div class="price-slider-wrapper">
                    <div class="price-input">
                        <input
                            v-model="filters.minPrice"
                            id="min" :placeholder="$t('min_price')"
                            @change="changeFilter('minPrice')"
                        />
                    </div>
                    <div class="line">-</div>
                    <div class="price-input">
                        <input
                            v-model="filters.maxPrice"
                            id="max"
                            :placeholder="$t('max_price')"
                            @change="changeFilter('maxPrice')"
                        />
                    </div>
                </div>
            </div>
            <div class="widget widget-brand sidebar-filter" v-if="brands.length">
                <h3 class="widgettitle">{{ $t('selectBrand') }}</h3>
                <ul class="list-brand">
                    <li v-for="brand in brands" :key="brand.id">
                        <Checkbox
                            id="brand"
                            :label="brand.name"
                            :input-value="brand.id"
                            v-model="filters.selectedBrands"
                            @change.native="changeFilter('brands')"
                        />
                    </li>
                </ul>
            </div>
            <div class="widget widget_filter_size sidebar-filter" v-if="sizes.length">
                <h4 class="widgettitle">{{ $t('selectSize') }}</h4>
                <ul class="list-brand">
                    <li v-for="size in sizes" :key="size.id">
                        <Checkbox
                            id="size"
                            :label="size.name"
                            :input-value="size.id"
                            v-model="filters.selectedSizes"
                            @change.native="changeFilter('sizes')"
                        />
                    </li>
                </ul>
            </div>
            <div class="widget widget-color sidebar-filter" v-if="colors">
                <h4 class="widgettitle">
                    {{ $t('selectColor') }}
                </h4>
                <div class="list-color">
                    <a v-for="color in colors"
                       :key="color.id"
                       :style="{backgroundColor: color.code}"
                       :class="{
                           active: filters.selectedColors.includes(color.id),
                           'black-check': color.name === 'White'
                         }"
                       class="pointer"
                       @click="selectColor(color)"
                    ></a>
                </div>
            </div>
            <div class="widget widget-tags sidebar-filter" v-if="tags && tags.length">
                <h3 class="widgettitle">
                    <!--          Popular Tags-->
                    {{ $t('mostViewed') }}
                </h3>
                <ul class="tagcloud">
                    <li
                        class="tag-cloud-link pointer"
                        v-for="tag in tags"
                        :key="tag.id"
                        :class="{active: filters.selectedTags.includes(tag.id) }"
                        @click="selectTag(tag)"
                    >
                        <a class="pointer">{{ tag.name }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import Checkbox from "@/components/custom-input/Checkbox";
import {mapGetters, mapMutations} from "vuex";

export default {
    name: "Sidebar",
    components: {Checkbox},
    props: {
        categories: {
            type: Array,
            default: () => null
        },
        brands: {
            type: Array,
            default: () => null
        },
        colors: {
            type: Array,
            default: () => null
        },
        sizes: {
            type: Array,
            default: () => null
        },
        tags: {
            type: Array,
            default: () => null
        },
        price: {
            type: Object,
            default: () => null
        },
        per_page: {
            default: () => null
        },
        by_price: {
            default: () => null
        },
        select_page: {
            default: () => null
        }
    },
    data() {
        return {
            filters: {
                selectedCategories: [],
                selectedBrands: [],
                selectedColors: [],
                selectedSizes: [],
                selectedTags: [],
                minPrice: "",
                maxPrice: "",
            },
            selectedCategories: [],
            selectedPage: null,
        }
    },
    computed: {
        ...mapGetters(["settings", "search", "page", "category", "otherFilters", "categoryBrands", 'categorySizes']),
    },
    watch: {
        select_page: {
            deep: true,
            handler(val) {
                this.selectedPage = val
                this.filterProduct()
            }
        },
        categories: {
            deep: true,
            handler() {
                this.checkSelectedCategories(this.$route.query['filter[categories]'])
            }
        },
        per_page: {
            deep: true,
            handler() {
                this.selectedPage = 1
                this.filterProduct()
            }
        },
        by_price: {
            deep: true,
            handler() {
                this.selectedPage = 1
                this.filterProduct()
            }
        },
        '$route.query': {
            immediate: true,
            deep: true,
            async handler(val) {
                if (val['filter[categories]']) {
                    this.filters.selectedCategories = this.queryToArray(val['filter[categories]']);
                    this.checkSelectedCategories(val['filter[categories]'])
                }
                if (val['filter[brands]']) {
                    this.filters.selectedBrands = this.queryToArray(val['filter[brands]'])
                }
                if (val['filter[colors]']) {
                    this.filters.selectedColors = this.queryToArray(val['filter[colors]'])
                }
                if (val['filter[sizes]']) {
                    this.filters.selectedSizes = this.queryToArray(val['filter[sizes]'])
                }
                if (val['filter[tags]']) {
                    this.filters.selectedTags = this.queryToArray(val['filter[tags]'])
                }
                if (val.search) {
                    this.setSearch(val.search.trim())
                }
                if (val['filter[by_price]']) {
                    this.setByPrice(val['filter[by_price]'])
                }
                if (val['filter[per_page]']) {
                    this.setPerPage(val['filter[per_page]'])
                }
                if (val['filter[page]']) {
                    this.setPage(val['filter[page]'])
                }
                if (val['filter[min_price]']) {
                    this.filters.minPrice = this.queryToArray(val['filter[min_price]'])
                }
                if (val['filter[max_price]']) {
                    this.filters.maxPrice = this.queryToArray(val['filter[max_price]'])
                }
            }
        }
    },
    mounted() {
        this.filters.selectedCategories = this.queryToArray(this.$route.query['filter[categories]'])
        this.filterProduct()
    },
    methods: {
        ...mapMutations(["setSearch", "setByPrice", "setPage", "setPerPage", 'setCategoryBrands', 'setCategorySizes']),

        checkSelectedCategories(categoryId) {
            if (this.categories.length) {
                let categoryFound = this.categories.some(item => item.id == categoryId);

                if (categoryFound) {
                    if (Array.isArray(categoryId)) {
                        this.selectedCategories = categoryId;
                    } else {
                        this.selectedCategories.push(categoryId);
                    }
                }
            }
        },

        getCategoryBrandsAndSizes() {
            this.selectedPage = 1
            if (!this.selectedCategories.length) {
                this.filters.selectedCategories = []
                this.filters.selectedCategories.push(this.categories[0].parent_id)
                this.selectedPage = null
            }
            this.$store.dispatch('getCategoryBrands', this.selectedCategories.length ? this.selectedCategories : this.filters.selectedCategories)
            this.$store.dispatch('getCategorySizes', this.selectedCategories.length ? this.selectedCategories : this.filters.selectedCategories)
            this.filterProduct()
        },

        changeFilter(filterType) {
            this.selectedPage = 1;
            if (
                (filterType === 'minPrice' && !this.filters.minPrice) ||
                (filterType === 'maxPrice' && !this.filters.maxPrice) ||
                (filterType === 'brands' && !this.filters.selectedBrands.length) ||
                (filterType === 'sizes' && !this.filters.selectedSizes.length)
            ) {
                this.selectedPage = null;
            }
            this.filterProduct();
        },

        queryToArray(val) {
            return typeof val === 'string' ? val.split(",").map(item => parseInt(item)) : val
        },

        selectColor(color) {
            this.selectedPage = 1
            if (!this.filters.selectedColors.length) {
                this.selectedPage = null
            }
            if (this.filters.selectedColors.includes(color.id)) {
                this.filters.selectedColors = this.filters.selectedColors.filter(item => item !== color.id)
            } else {
                this.filters.selectedColors.push(color.id)
            }
            this.filterProduct()
        },

        selectTag(tag) {
            this.selectedPage = 1
            if (!this.filters.selectedTags.length) {
                this.selectedPage = null
            }
            if (this.filters.selectedTags.includes(tag.id)) {
                this.filters.selectedTags = this.filters.selectedTags.filter(item => item !== tag.id)
            } else {
                this.filters.selectedTags.push(tag.id)
            }
            this.filterProduct()
        },

        filterProduct() {
            const data = {
                'filter[categories]': this.selectedCategories.length ? this.selectedCategories : this.filters.selectedCategories,
                'filter[brands]': this.filters.selectedBrands,
                'filter[colors]': this.filters.selectedColors,
                'filter[sizes]': this.filters.selectedSizes,
                'filter[tags]': this.filters.selectedTags,
                'filter[by_price]': this.by_price,
                'filter[per_page]': this.per_page,
                'filter[min_price]': this.filters.minPrice,
                'filter[max_price]': this.filters.maxPrice,
                search: this.search,
                'filter[page]': this.selectedPage ? this.selectedPage : this.page,
            }
            const queryData = {...data}
            const params = new URLSearchParams(queryData).toString();
            window.history.replaceState(null, null, '?' + params);
            this.$store.dispatch('getFilteredProducts', data)
        },

        categoryName(names) {
            return names[this.$i18n.locale]
        }
    }
}
</script>

<style lang="scss">

.widget_filter_price {
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}

.price-slider-wrapper {
    display: flex;
    align-items: center;
    width: 100%;

    .line {
        margin: 0 8px;
    }

    .price-input {
        width: 50%;

        label {
            margin: 0;
            color: #555;
        }

        input {
            width: 100%;
            color: #555;
            border: 1px solid #c9c9c9;
            border-radius: 10px;
            padding: 5px;
        }

        input::placeholder {
            color: #c9c9c9;
        }
    }
}
</style>