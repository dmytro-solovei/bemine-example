<template>
    <div class="product-inner equal-element" v-if="product" :style="styleObject">
        <template v-if="layout === 'grid'">
            <div class="product-top">
                <div v-if="product.new" class="flash">
                  <span class="onnew">
                    <span class="text">
                        {{ $t('new') }}
                    </span>
                  </span>
                </div>
            </div>
            <div class="product-thumb">
                <div class="thumb-inner">
                    <router-link :to="{name: 'Product', params: {slug : product.slug}}">
                        <img :src="product.avatar" alt="img">
                    </router-link>
                    <div class="thumb-group">
                        <div class="yith-wcwl-add-to-wishlist">
                            <div class="yith-wcwl-add-button">
                                <div
                                    v-if="$route.name === 'WishList'"
                                    class="product-remove"
                                    :style="styleObject">
                                      <span @click="showDeletePopup = product.id" style="cursor: pointer;">
                                        <i aria-hidden="true" class="fa fa-trash-o"></i>
                                      </span>
                                </div>
                                <a
                                    v-else
                                    style="cursor: pointer;"
                                    :class="{ 'active-heart': hasInWishlist(product.id) }"
                                    @click.stop="addToWishList(product)"
                                >{{ $t('like') }}</a>
                            </div>
                        </div>
                        <a class="button quick-wiew-button" @click.stop="openModal(product)" style="cursor: pointer;">
                            {{ $t('quick_view') }}
                        </a>
                    </div>
                </div>
            </div>
            <div class="product-info">
                <router-link :to="{name: 'Product', params: {slug : product.slug}}">
                    <div v-if="endDate" class="product-count-down" :style="styleObject">
                        <Countdown :end="endDate"/>
                    </div>
                    <div class="group-info">
                        <div class="price">
                            <div v-if="product.price === product.old_price">
                                <ins :style="styleObject" class="new-price">
                                    {{ product.price }} {{settings ? settings.currency_value : null }}
                                </ins>
                            </div>
                            <div v-else>
                                <ins :style="styleObject" class="new-price">
                                    {{ product.price }} {{settings ? settings.currency_value : null }}
                                </ins>
                                <del v-if="product.old_price" class="old-price">
                                    {{ product.old_price }} {{settings ? settings.currency_value : null }}
                                </del>
                            </div>
                        </div>
                        <h5 class="product-name product_title">
                            <router-link :to="{name: 'Product', params: {slug : product.slug}}">{{ product.title }}
                            </router-link>
                        </h5>
                        <div class="stars-rating">
                            <div class="star-rating">
                                <span :class="'star-' + product.countStar"></span>
                            </div>
                            <div class="count-star">
                                ({{ product.stars_rate }})
                            </div>
                        </div>
                    </div>
                </router-link>
            </div>
        </template>
        <DeletePopup
            v-if="showDeletePopup"
            @confirm="removeHandler"
            @close="closeModal"
        />
    </div>
</template>

<script>
import DeletePopup from "@/components/DeletePopup.vue";
import {bus} from '@/main'
import Countdown from 'vuejs-countdown'
import productMixin from "@/mixins/product.mixin";
import {mapGetters} from "vuex";

export default {
    name: "ProductCart",
    props: {
        layout: {
            type: String,
            default: 'grid'
        },
        index: {
            type: Number,
        },
        product: {
            type: Object,
            default: () => null
        },
        endDate: {
            type: String,
            default: ""
        }
    },
    components: {Countdown, DeletePopup},
    mixins: [productMixin],
    data() {
        return {
            showDeletePopup: false,
        }
    },
    methods: {
        openModal(data) {
            bus.$emit('open-modal', {...data})
        },
        closeModal() {
            this.showDeletePopup = false
        },
        removeHandler() {
            this.removeWishListItem(this.showDeletePopup)
            this.closeModal()
        },
    },
    computed: {
        ...mapGetters(["settings"]),
        styleObject: function () {
            return {
                '--bg-color': this.settings ? this.settings.main_color : 'white',
            }
        }
    }
}
</script>

<style scoped lang="scss">
.thumb-inner img {
    width: 100%;
    object-fit: cover;
    height: 350px;
    @media(max-width: 768px) {
        height: 350px;
    }
}

.product-remove {
    display: inline-block;
    color: #555;
    font-size: 22px;

    &:hover {
        color: #c09578;
    }
}
</style>

<style lang="scss">
.product-count-down {
    margin-bottom: 7px;
}

.vuejs-countdown {
    text-align: center;
}

.vuejs-countdown li {
    display: inline-block;
    vertical-align: middle;
    text-align: center;
    text-align: center;
    padding: 7px 0 7px;
    min-width: 40px;
    border-radius: 50%;
    font-family: 'Raleway';
    font-weight: 700;
    margin-bottom: 7px;
    position: relative;
    /*background-color: #c09578;*/
    background-color: var(--bg-color);
    color: #fff;
    @media(max-width: 480px) {
        margin: 0 2px;
    }
}

ins {
    color: var(--bg-color) !important;
}

.vuejs-countdown li:after {
    display: none;
}

.vuejs-countdown li:last-child {
    margin-right: 0;
}

.vuejs-countdown li p {
    display: block;
    text-align: center;
    line-height: 12px;
}

.vuejs-countdown li .digit {
    font-size: 11px;
    line-height: 11px;
    padding-bottom: 3px;
}

.vuejs-countdown li .text {
    font-size: 9px;
    text-transform: uppercase;
}

.product-inner:hover {
    border-color: var(--bg-color) !important
}

.fa-trash-o:hover {
    color: var(--bg-color) !important;
}

.thumb-group:hover a {
    color: var(--bg-color) !important;
}


</style>
