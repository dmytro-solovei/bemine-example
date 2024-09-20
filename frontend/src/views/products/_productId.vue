<template>
    <div :style="styleObject" class="main-content main-content-details single no-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <Breadcrumbs/>
                </div>
            </div>
            <div class="row">
                <div class="content-area content-details full-width col-lg-9 col-md-8 col-sm-12 col-xs-12">
                    <div class="site-main" v-if="product">
                        <div class="details-product">
                            <div class="details-thumd">
                                <div class="image-preview-container image-thick-box image_preview_container">
                                    <inner-image-zoom
                                        :src="img"
                                        :zoom-src="img"
                                        :hide-hint="true"
                                        zoom-type="hover"
                                    />
                                </div>
                                <div class="product-preview image-small product_preview">
                                    <carousel
                                        :margin="5" :dots="false" class="thumbnails_carousel"
                                        :responsive="{'0':{'items':3},'480':{'items':3},'600':{'items':3},'1000':{'items':3}}"
                                        :nav-text="[`<i class='fa fa-angle-left' aria-hidden='true'></i>`, `<i class='fa fa-angle-right' aria-hidden='true'></i>`]"
                                        :key="activeBlock+img"
                                    >
                                        <a href="javascript:void(0)"
                                           :class="{'active': img === i.image}"
                                           v-for="i in coloredProduct.images"
                                           :key="i.id"
                                           @click.prevent="setActiveImg(i.image)"
                                        >
                                            <img :src="i.image" alt="img">
                                        </a>
                                    </carousel>
                                </div>
                            </div>
                            <div class="details-infor">
                                <div class="details-info-title">
                                    <h1 class="product-title">
                                        {{ product.title }}
                                    </h1>
                                    <img :src="product.brand.avatar" alt="">
                                </div>
                                <div class="stars-rating">
                                    <div class="star-rating">
                                        <span class="star-5"></span>
                                    </div>
                                    <div class="count-star">
                                        ({{ product.stars_rate }})
                                    </div>
                                </div>
                                <div class="availability">
                                    <a :style="{'color': design ? design.main_color : 'white'}">{{
                                            product.available_type === 'is_available' ? $t('is_available') : $t('not_available')
                                        }}</a>
                                </div>
                                <div class="price">
                                    <span>{{ product.price }} {{ design ? design.currency_value : null}}</span>
                                </div>
                                <div v-for="(item, i) in product.details.information" :key="i" class="product-details-description">
                                    <ul v-if="item.key !== null">
                                        <li>
                                          {{ item.key }}: {{ item.value }}
                                        </li>
                                    </ul>
                                </div>
                                <div class="variations group-button" style="position: relative">
                                    <div class="attribute attribute_color">
                                        <div class="color-text text-attribute">{{ $t('color') }}</div>
                                        <div class="list-color list-item">
                                            <a v-for="color in colors"
                                               :key="color.id"
                                               :style="{backgroundColor: color.code}"
                                               :class="{
                                                   active: activeColor(color),
                                                   'black-check': color.name === 'White'
                                                 }"
                                               @click.prevent="selectColor(color)"
                                            ></a>
                                        </div>
                                        <p v-if="showColorError" class="error-message color-error">Ընտրեք գույնը</p>
                                    </div>
                                    <div class="attribute attribute_size">
                                        <div class="size-text text-attribute">{{ $t('size') }}</div>
                                        <div class="list-size list-item" :style="styleObject">
                                            <a v-for="item in coloredProduct.sizes"
                                               :key="item.id"
                                               :class="{active: size && size.id === item.id}"
                                               @click="size = item"
                                            >{{ item.name }}</a>
                                            <p v-if="showSizeError" class="error-message size-error">Ընտրեք չափսը</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="group-button" style="position: relative">
                                    <div class="yith-wcwl-add-to-wishlist wishlist-notify-wrap">
                                        <div v-if="addedWishList" class="success-notify wishlist-success-notify">
                                            <div class="bubble">
                                                {{ addedWishList === 'added' ? 'Ավելացվել է' : 'Ջնջվել է' }}
                                            </div>
                                            <div class="triangle"></div>
                                        </div>
                                        <div class="yith-wcwl-add-button">
                                            <a
                                                :class="{ 'active-heart': hasInWishlist(product.id) }"
                                                @click="addToWishList(product)"
                                                style="cursor: pointer"
                                            ></a>
                                        </div>
                                    </div>
                                    <div v-if="showSuccessNotify" class="success-notify">
                                        <div class="bubble">{{ $t('product_cart') }}</div>
                                        <div class="triangle"></div>
                                    </div>
                                    <div class="quantity-add-to-cart">
                                        <div class="quantity">
                                            <div class="control">
                                                <a class="btn-number qtychange qtyminus quantity-minus"
                                                   @click="changeCount(-1)" :style="styleObject">-</a>
                                                <input
                                                    v-model="count"
                                                    type="text"
                                                    data-step="1"
                                                    data-min="0"
                                                    title="Qty"
                                                    class="input-qty qty"
                                                    size="4"
                                                >
                                                <a class="btn-number qtychange qtyplus quantity-plus"
                                                   @click="changeCount(+1)" :style="styleObject">+</a>
                                            </div>
                                        </div>
                                        <button class="single_add_to_cart_button button" @click.stop="addToCartHandler"
                                                :style="{'background-color': design ? design.main_color : null}">
                                            {{ $t('add_to_cart') }}
                                        </button>
                                    </div>
                                    <p v-if="count < 1" class="error-message">{{ $t('select_quantity') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-details-product">
                            <ul class="tab-link">
                                <li :class="{active: tabPanel === 'Description'}">
                                    <a data-toggle="tab" aria-expanded="true" href="javascript:void(0)"
                                       @click="tabPanel = 'Description'"
                                       :style="styleObject">{{ $t('description') }}</a>
                                </li>
                                <li v-if="isTablePanel" :class="{active: tabPanel === 'Information'}">
                                    <a data-toggle="tab" aria-expanded="true" href="javascript:void(0)"
                                       @click="tabPanel = 'Information'"
                                       :style="styleObject">{{ $t('characteristics') }}</a>
                                </li>
                            </ul>
                            <div class="tab-container">
                                <component class="active"
                                           :is="tabPanel"
                                           :description="product.details.description"
                                           :information="product.details.information"
                                ></component>
                            </div>
                        </div>
                        <div style="clear: left;"></div>
                        <div v-if="product.suggested_products && product.suggested_products.length"
                             class="related products product-grid">
                            <h2 class="product-grid-title">{{ $t('similar_products') }}</h2>
                            <vue-slick-carousel
                                v-bind="settings"
                                class="owl-products nav-center suggested-products"
                            >
                                <template #prevArrow>
                                    <span></span>
                                </template>
                                <div
                                    class="product-item style-1"
                                    v-for="(prod, idx) in product.suggested_products"
                                    :key="idx"
                                >
                                    <ProductCart :product="prod"/>
                                </div>
                                <template #nextArrow>
                                    <span></span>
                                </template>
                            </vue-slick-carousel>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import VueSlickCarousel from "vue-slick-carousel";
import carousel from 'vue-owl-carousel'
import InnerImageZoom from 'vue-inner-image-zoom';
import ProductCart from "@/components/products/ProductCart";
import Description from "@/components/products/Description";
import Information from "@/components/products/Information";
import Breadcrumbs from "@/components/Breadcrumbs";
import productMixin from "@/mixins/product.mixin";
import {mapGetters} from "vuex";

export default {
    name: "Product",
    props: ['slug'],
    mixins: [productMixin],
    components: {Breadcrumbs, VueSlickCarousel, carousel, InnerImageZoom, ProductCart, Description, Information},
    data() {
        return {
            tabPanel: 'Description',
            settings: {
                "autoplay": false,
                "autoplaySpeed": 1000,
                "arrows": true,
                "dots": false,
                "infinite": true,
                "speed": 800,
                "slidesToShow": 3,
                "slidesToScroll": 1,
                responsive: [
                    {"breakpoint": 2000, "settings": {"slidesToShow": 3}},
                    {"breakpoint": 1200, "settings": {"slidesToShow": 2}},
                    {"breakpoint": 480, "settings": {"slidesToShow": 1}}
                ]
            },
            count: 1,
            size: null,
            color: null,
            showSizeError: false,
            showColorError: false,
            showSuccessNotify: false,
            isTablePanel: false,
        }
    },
    computed: {
        ...mapGetters({"design": "settings"}),
        styleObject: function () {
            return {
                '--bg-color': this.design ? this.design.main_color : 'white',
            }
        },
        product() {
            let product = this.$store.state.product
            if (product && product.details) {
                for (const key in product.details.information) {
                    // eslint-disable-next-line no-prototype-builtins
                    if (product.details.information.hasOwnProperty(key)) {
                        if (product.details.information[key].key && product.details.information[key].value) {
                            // eslint-disable-next-line vue/no-side-effects-in-computed-properties
                            this.isTablePanel = true
                        }
                    }
                }
            }
            return product
        },
    },
    watch: {
        size: {
            deep: true,
            handler(val) {
                if (val) {
                    this.showSizeError = false
                }
            }
        },
        color: {
            deep: true,
            handler(val) {
                if (val) {
                    this.size = null
                }
            }
        }
    },
    mounted() {
        this.$store.dispatch('getProduct', this.slug)
    },
    methods: {
        activeColor(color) {
            if (color.block === this.block) {
                this.color = color
            }
            return color.block === this.block
        },
        changeCount(qty) {
            if (this.count === 1 && qty === -1) return;
            this.count = parseInt(this.count) + parseInt(qty)
        },
        selectColor(color) {
            this.color = color
            this.setActiveColor(color.block)
        },
        addToCartHandler() {
            if (!this.color) this.showColorError = true;
            if (!this.size) this.showSizeError = true;
            if (!this.color || !this.size || this.count < 1) return;
            const product = {
                ...this.product,
                color: this.color,
                size: this.size,
                count: this.count,
            }
            this.addToCart(product)
            this.$store.commit('setOpenMiniCartFromProduct', true)
            // this.showSuccessNotify = true
            setTimeout(() => {
                this.$store.commit('setOpenMiniCartFromProduct', false)
            }, 1500)
        }
    }
}
</script>

<style>
.details-info-title {
    display: flex;
    align-items: center;
}

.details-info-title img {
    width: 100px;
    margin-bottom: 15px;
    margin-top: -9px;
}

.details-info-title .product-title {
    margin-right: 20px;
}

.details-thumd .image-preview-container {
    margin-bottom: 0;
    border: none;
}

.owl-theme .owl-nav [class*='owl-']:hover {
    color: #c09578 !important;
}

.product-preview.image-small.product_preview img {
    height: 100%;
    object-fit: cover;
}

picture > img.iiz__img {
    height: 533px !important;
    width: 533px !important;
    object-fit: cover;
}

.list-item a {
    cursor: pointer;
}

.qtychange {
    user-select: none;
    cursor: pointer;
}

.error-message {
    color: #ce1313;
}

.color-error {
    margin: -20px 0 0 0;
}

.size-error {
    margin-top: 5px;
}

.thumbnails_carousel a {
    display: block;
    height: 120px;
}

</style>

<style lang="scss">
a:hover {
    color: var(--bg-color) !important;
}

.tab-details-product .tab-link li.active a {
    color: var(--bg-color) !important;
}

.tab-details-product .tab-link li.active a::after {
    background: var(--bg-color) !important;
}

.details-thumd .thumbnails_carousel .owl-item a.active::before {
    border-color: var(--bg-color) !important;
}

.bubble {
    background-color: var(--bg-color) !important;
}

.triangle {
    background-color: var(--bg-color) !important;
}
.product-grid-title {
  color: var(--bg-color);
}
.product-grid-title::before {
  border-bottom: 4px solid var(--bg-color);
}

@media screen and (max-width: 768px) {
    .details-info-title {
        display: block;
    }
    .details-info-title .product-title {
        margin-bottom: 20px;
    }
}
</style>

