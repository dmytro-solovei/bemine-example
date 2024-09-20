<template>
  <div id="app">
    <MobileMenu/>
    <TheHeader/>
    <router-view :key="$route.fullPath"/>
    <TheFooter/>
    <BackToTop/>
    <ProductModal/>
  </div>
</template>

<script>
import TheHeader from "@/components/layout/TheHeader";
import TheFooter from "@/components/layout/TheFooter";
import BackToTop from "@/components/BackToTop";
import ProductModal from "@/components/ProductModal";
import MobileMenu from "@/components/layout/MobileMenu"
import {mapGetters} from "vuex";

export default {
  name: "App",
  components: {
    ProductModal,
    BackToTop,
    TheHeader,
    TheFooter,
    MobileMenu
  },
    computed: {
        ...mapGetters(["settings"]),
        astyleObject: function () {
            return this.settings
        }
    },
    watch: {
        astyleObject: {
            handler(newStyle) {
                this.applyStyle(newStyle);
            },
            immediate: true
        }
    },
  mounted() {
    this.$store.dispatch('getPageSettings')
    this.$store.dispatch('getCategories')
  },
    methods: {
        applyStyle(newStyle) {
            if (newStyle) {
                const checkbox = document.querySelectorAll('body');
                for (let i = 0; i < checkbox.length; i++) {
                    checkbox[i].style.setProperty('--main-color', newStyle.main_color);
                }
            }
        }
    }
}
</script>
<style>
a:hover, a:focus, a:active,
.quantity .btn-number:hover,
.view:hover, .s-comments:hover, .cart-form .product-remove:hover a:before,
.cart-form .shop_table .product-name .attributes-select:hover, .cart-form .coupon .button:hover,
.list-product-order .attributes-select:hover, .header-language .ysera-submenu > li > a:hover, .sidebar input[type="checkbox"]:checked + label::before,
.block-minicart .no-product .text span,
.details-thumd .owl-nav div:hover, .details-infor .availability a,
.details-infor .group-button .yith-wcwl-add-to-wishlist div a:hover::before,
.tab-details-product .tab-link li.active a,
.related .slick-slider.nav-center > .slick-arrow:hover, .up-sells .slick-slider.nav-center > .slick-arrow:hover, .slider-item .button:hover, .slick-slider.nav-center > .slick-arrow:hover {
    color: var(--main-color) !important;
}
</style>
