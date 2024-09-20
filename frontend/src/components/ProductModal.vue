<template>
  <div v-if="openModal">
    <div class="mfp-bg mfp-ready"></div>
    <div class="mfp-wrap mfp-close-btn-in mfp-auto-cursor mfp-ready" tabindex="-1">
      <div class="mfp-container mfp-s-ready mfp-inline-holder">
        <div class="mfp-content">
          <div class="kt-popup-quickview">
            <div class="details-thumb">
              <div class="slider-product slider-for slick-initialized slick-slider">
                <div aria-live="polite" class="slick-list draggable">
                  <div class="slick-track" role="listbox">
                    <div st class="details-item slick-slide slick-current slick-active" :style="styleObject">
                      <img :src="img" alt="img">
                    </div>
                  </div>
                </div>
              </div>
              <vue-slick-carousel class="slider-product-button nav-center " v-bind="settings">
                <template #prevArrow>
                  <span></span>
                </template>
                <div href="javascript:void(0)"
                   :class="['details-item',  img === i.image ? 'slick-current' : null]"
                   v-for="i in coloredProduct.images"
                   :key="i.id"
                   @click.prevent="setActiveImg(i.image)"
                >
                  <img :src="i.image" alt="img">
                </div>
<!--                <div :class="" v-for="i in 4" :key="i" @click="currentImg = i">-->
<!--                  <img :src="`http://ledthanhdat.vn/html/ysera/assets/images/details-item-${i}.jpg`" alt="img">-->
<!--                </div>-->
                <template #nextArrow>
                  <span></span>
                </template>
              </vue-slick-carousel>
            </div>
            <div class="details-infor">
              <h1 class="product-title">{{product.title}}</h1>
              <div class="stars-rating">
                <div class="star-rating">
                  <span class="star-5"></span>
                </div>
                <div class="count-star">
                  ({{product.stars_rate}})
                </div>
              </div>
              <div class="availability"><a  :style="{'color': design ? design.main_color : 'white'}">{{product.available_type === 'is_available' ? 'Հասանելի է' : 'Հասանելի չէ'}}</a></div>
              <div class="price"><span>{{product.price}} դրամ</span></div>
              <div class="product-details-description">
                <ul v-if="product.details.additional">
                  <li
                      v-for="(item, i) in product.details.additional"
                      :key="i"
                  >
                    {{item}}
                  </li>
                </ul>
              </div>
              <div class="variations">
                <div class="attribute attribute_color">
                  <div class="color-text text-attribute">Գույն</div>
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
                  <p v-if="showColorError" class="error-message color-error">{{ $t('choose_color') }}</p>
                </div>
                <div class="attribute attribute_size">
                  <div class="size-text text-attribute">{{ $t('size') }}</div>
                  <div class="list-size list-item" :style="styleObject">
                    <a v-for="item in coloredProduct.sizes"
                       :key="item.id"
                       :class="{active: size && size.id === item.id}"
                       @click="size = item"
                    >{{item.name}}</a>
                  </div>
                  <p v-if="showSizeError" class="error-message size-error">{{ $t('choose_size') }}</p>
                </div>
              </div>
              <div class="group-button">
                <div class="yith-wcwl-add-to-wishlist wishlist-notify-wrap" >
                  <div v-if="addedWishList" class="success-notify wishlist-success-notify" >
                    <div class="bubble" :style="{'background': design ? design.main_color : 'white'}">{{ addedWishList === 'added' ? $t('added') : $t('deleted') }}</div>
                    <div class="triangle" :style="{'background': design ? design.main_color : 'white'}"></div>
                  </div>
                  <div class="yith-wcwl-add-button"   :style="styleObject" >
                    <a
                        :class="{ 'active-heart': hasInWishlist(product.id) }"
                        @click.stop="addToWishList(product)"
                    ></a>
                  </div>
                </div>
                <div class="quantity-add-to-cart">
                  <div class="quantity">
                    <div class="control">
                      <a class="btn-number qtychange qtyminus quantity-minus" @click="changeCount(-1)" :style="styleObject">-</a>
                      <input v-model="count" type="text" data-step="1" data-min="0" title="Qty" class="input-qty qty" size="4">
                      <a class="btn-number qtychange qtyplus quantity-plus" @click="changeCount(+1)" :style="styleObject">+</a>
                    </div>
                  </div>
                  <button class="single_add_to_cart_button button" @click.stop="addToCartHandler(product.id)" :style="{'background': design ? design.main_color : 'white'}">{{ $t('add_to_cart') }}</button>
                </div>
                <p v-if="count < 1" class="error-message">{{ $t('select_quantity') }}</p>
              </div>
            </div>
            <button title="Close (Esc)" type="button" class="mfp-close" @click="closeModal" :style="{'background': design ? design.main_color : 'white'}">×</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {bus} from '@/main'
import VueSlickCarousel from "vue-slick-carousel";
import productMixin from "@/mixins/product.mixin";
import {mapGetters} from "vuex";
export default {
  name: "ProductModal",
  components: { VueSlickCarousel },
  mixins: [productMixin],
  data() {
    return {
      openModal: false,
      product: null,
      settings: {
        "arrows":true,
        "dots":false,
        "infinite": false,
        "speed":1000,
        "slidesToShow": 3,
        "slidesToScroll": 1,
        responsive: [
          {breakpoint: 2000, settings: {slidesToShow: 3}}
        ]
      },
      count: 1,
      size: null,
      color: null,
      showSizeError: false,
      showColorError: false,
    }
  },
  computed: {
    ...mapGetters({"design": "settings"}),
    styleObject: function () {
      return {
        '--bg-color': this.design ? this.design.main_color : null,
      }
    },
  },
  watch: {
    size: {
      deep: true,
      handler(val) {
        if(val) {
          this.showSizeError = false
        }
      }
    },
    color: {
      deep: true,
      handler(val) {
        if(val) {
          this.size= null
        }
      }
    }
  },
  created() {
    bus.$on('open-modal', this.setData)
    bus.$on('close-modal', this.clearData)
  },
  destroyed() {
    bus.$off('open-modal')
    bus.$off('close-modal')
  },
  methods: {
    setData(data) {
      this.product = data
      this.openModal = true
      window.document.documentElement.style.overflow = 'hidden'
    },
    clearData() {
      this.product = null
      this.openModal = false
      this.setActiveImg(null)
      window.document.documentElement.style.overflow = 'unset'
    },
    closeModal() {
      bus.$emit('close-modal')
    },
    activeColor(color) {
      if(color.block === this.block) {
        this.color = color
      }
      return color.block === this.block
    },
    changeCount(qty) {
      if(this.count === 1 && qty === -1) return;
      this.count = parseInt(this.count) + parseInt(qty)
    },
    selectColor(color) {
      this.color = color
      this.setActiveColor(color.block)
    },
    addToCartHandler() {
      if(!this.color) this.showColorError = true;
      if(!this.size) this.showSizeError = true;
      if(!this.color || !this.size || this.count < 1) return;
      const product = {
        ...this.product,
        color: this.color,
        size: this.size,
        count: this.count,
      }
      this.addToCart(product);
      this.closeModal()
    }
  }
}
</script>

<style lang="scss">
.details-item {
    height: 120px;
    margin-right: 8px;
}
.details-item img {
    width: 100%;
    height: 100%;
}
.slick-slide img{
  object-fit: cover;
}
.slider-product  img {
  height: 350px!important;
  width: 350px!important;
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
  margin: -15px 0 0 0;
}
.active-heart{
  cursor: pointer;
  color: var(--bg-color) !important;
}
.slick-dots li.slick-active::before{
  border:2px solid var(--bg-color) !important
}
a:hover{
  color: var(--bg-color) !important;
}
.details-infor .group-button .yith-wcwl-add-to-wishlist div a::before{
  color: var(--bg-color) !important;
}
.attribute_size .list-size a:hover{
  background: var(--bg-color) !important;
  color: white !important;
}
.attribute_size .list-size a.active{
  background: var(--bg-color) !important;
  color: white !important;
}
@media (max-width: 768px) {
  .kt-popup-quickview {
    width: 96%!important;
  }
  .kt-popup-quickview .details-infor {
    padding-left: 0!important;
    margin-top: 20px;
  }
  .kt-popup-quickview .details-thumb {
    margin-bottom: 20px;
    width: 100%!important;
  }
  .kt-popup-quickview .details-infor {
    width: 100%!important;
  }
  .kt-popup-quickview .mfp-close {
    right: 0!important;
  }

}
</style>