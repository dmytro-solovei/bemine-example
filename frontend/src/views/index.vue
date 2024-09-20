<template>
  <div class="home">
    <div>
      <div class="fullwidth-template">
        <div class="home-slider-banner">
          <div class="container">
            <div class="row10">
              <div class="col-lg-8 silider-wrapp">
                <div class="home-slider"
                     v-if="mainProducts && mainProducts.slideItems && mainProducts.slideItems.length"
                >
                  <vue-slick-carousel
                      class="slider-owl owl-slick"
                      v-bind="settings"
                  >
                    <div
                        v-for="product in mainProducts.slideItems"
                        :key="product.id"
                        class="slider-item style9"
                    >
                      <div
                          class="slider-inner equal-element"
                          :style="{backgroundImage: `url(${product.avatar})`}"
                      >
                        <div class="slider-infor">
                          <h3 class="title-big custom-title">
                            {{product.title}}
                          </h3>
                          <a
                              class="button btn-shop-the-look bgroud-style"
                              :style="styleObject"
                              @click="viewProductPage(product.categoryId)"
                          >
                            {{ $t('sale') }}
                          </a>
                        </div>
                      </div>
                    </div>
                  </vue-slick-carousel>
                </div>
              </div>
              <div
                  v-if="mainProducts && mainProducts.bannerItems && mainProducts.bannerItems.length"
                  class="col-lg-4 banner-wrapp mainProducts_wrap"
              >
                <banner
                    v-for="product in mainProducts.bannerItems"
                    :key="product.id"
                    img-class="style7"
                    :backgroundImage="product.avatar"
                    class="col-xs-6 col-lg-12"
                >
                  <a
                      class="button btn-lets-do-it"
                      @click="viewProductPage(product.categoryId)"
                      :style="styleObject">
                    {{ $t('sale') }}
                  </a>
                </banner>
              </div>
            </div>
          </div>
        </div>
        <div
            v-if="dealDayProducts && dealDayProducts.length"
             class="ysera-product produc-featured rows-space-65"
        >
          <div class="container">
            <h3 class="custommenu-title-blog" :style="styleObject">
              {{$t('offers')}}
            </h3>
            <vue-slick-carousel
                class="owl-products owl-slick"
                v-bind="productsSettings"
                :style="styleObject"
            >
              <a
                  v-for="(item, i) in dealDayProducts"
                  :key="i"
                  class="product-item style-5"
              >
                <ProductCart :product="item.product" :endDate="item.date_end"/>
              </a>
            </vue-slick-carousel>
          </div>
        </div>
        <div class="ysera-tabs  default rows-space-40">
          <div class="container">
            <div class="tab-head">
              <ul class="tab-link" :style="styleObject">
                <li :class="[activeTabPanel === 'bestseller' ? 'active' : '']">
                  <a data-toggle="tab" aria-expanded="true" href="javascript:void(0)" @click="activeTabPanel = 'bestseller'">{{$t('bestSeller')}}</a>
                </li>
                <li :class="activeTabPanel === 'newArrivals' ? 'active' : ''">
                  <a data-toggle="tab" aria-expanded="true" href="javascript:void(0)" @click="activeTabPanel = 'newArrivals'">{{$t('news')}}</a>
                </li>
                <li :class="activeTabPanel === 'topRated' ? 'active' : ''">
                  <a data-toggle="tab" aria-expanded="true" href="javascript:void(0)" @click="activeTabPanel = 'topRated'">{{$t('bestSellers')}}</a>
                </li>
              </ul>
            </div>
            <div class="tab-container">
              <div class="tab-panel active">
                <div class="ysera-product">
                  <ul
                      v-if="topPanel[activeTabPanel] && topPanel[activeTabPanel].length"
                      class="row list-products auto-clear equal-container product-grid"
                  >
                    <li
                        class="product-item  col-lg-3 col-md-4 col-sm-6 col-xs-6 col-ts-6 style-1"
                        v-for="(prod, idx) in topPanel[activeTabPanel]"
                        :key="idx"
                    >
                      <ProductCart :product="prod.product"/>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div
            v-if="bottomSlideProducts && bottomSlideProducts.length"
            class="banner-wrapp"
        >
          <div class="container">
            <div class="row">
              <div
                  v-for="product in bottomSlideProducts"
                  :key="product.id"
                  class="col-lg-6 col-md-6 col-sm-6 col-xs-6 banner-wrapp-item">
                <a @click="viewProductPage(product.categoryId)">
                  <banner img-class="style4" :backgroundImage="product.avatar">
                    <div class="button btn-shop-now" :style="styleObject">
                      {{ $t('sale') }}
                    </div>
                  </banner>
                </a>
              </div>
            </div>
          </div>
        </div>

        <div class="ysera-iconbox-wrapp default" :style="{'background-color': design ? design.main_color : 'transparent'}">
          <div class="container">
            <div class="row">
              <div class="col-sm-12 col-xs-12">
                <div class="ysera-iconbox default">
                  <div class="iconbox-inner">
                    <div class="icon">
                      <span class="flaticon-delivery-truck"></span>
                    </div>
                    <div class="content">
                      <h4 class="title free-title">
                        {{$t('freeDeliveryText')}}
                      </h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="instagram-wrapp" :style="styleObject">
      <div>
        <h3 class="custommenu-title-blog">
          <i class="flaticon-instagram" aria-hidden="true"></i>
          Instagram Feed
        </h3>
        <div class="ysera-instagram">
          <vue-slick-carousel class="instagram" v-bind="instagramSettings">
            <div class="item-instagram">
              <a href="https://www.instagram.com/p/ChsSSxUIq3x/?img_index=1" target="_blank">
                <img src="../assets/images/inst_1.jpg" alt="img">
              </a>
              <a href="https://www.instagram.com/p/ChsSSxUIq3x/?img_index=1" target="_blank" class="text">
                <i class="icon flaticon-instagram" aria-hidden="true"></i>
              </a>
            </div>
            <div class="item-instagram">
              <a href="https://www.instagram.com/p/Chzx6gsokda/?img_index=1" target="_blank">
                <img src="../assets/images/inst_2.jpg" alt="img">
              </a>
              <a href="https://www.instagram.com/p/Chzx6gsokda/?img_index=1" target="_blank" class="text">
                <i class="icon flaticon-instagram" aria-hidden="true"></i>
              </a>
            </div>
            <div class="item-instagram">
              <a href="https://www.instagram.com/p/CiKL81EocQQ/?img_index=1" target="_blank">
                <img src="../assets/images/inst_3.jpg" alt="img">
              </a>
              <a href="https://www.instagram.com/p/CiKL81EocQQ/?img_index=1" target="_blank" class="text">
                <i class="icon flaticon-instagram" aria-hidden="true"></i>
              </a>
            </div>
            <div class="item-instagram">
              <a href="https://www.instagram.com/p/Ch4YmplIzu1/?img_index=1" target="_blank">
                <img src="../assets/images/inst_4.jpg" alt="img">
              </a>
              <a href="https://www.instagram.com/p/Ch4YmplIzu1/?img_index=1" target="_blank" class="text">
                <i class="icon flaticon-instagram" aria-hidden="true"></i>
              </a>
            </div>
            <div class="item-instagram">
              <a href="https://www.instagram.com/p/Chr9OnCIlOu/?img_index=1" target="_blank">
                <img src="../assets/images/inst_5.jpg" alt="img">
              </a>
              <a href="https://www.instagram.com/p/Chr9OnCIlOu/?img_index=1" target="_blank" class="text">
                <i class="icon flaticon-instagram" aria-hidden="true"></i>
              </a>
            </div>
            <div class="item-instagram">
              <a href="https://www.instagram.com/p/ChkjN2HI_Lb/?img_index=1" target="_blank">
                <img src="../assets/images/inst_6.jpg" alt="img">
              </a>
              <a href="https://www.instagram.com/p/ChkjN2HI_Lb/?img_index=1" target="_blank" class="text">
                <i class="icon flaticon-instagram" aria-hidden="true"></i>
              </a>
            </div>
          </vue-slick-carousel>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import VueSlickCarousel from 'vue-slick-carousel'
import ProductCart from "@/components/products/ProductCart";
import Banner from '@/components/Banner'
import {mapGetters} from "vuex";

export default {
  name: 'Home',
  components: {ProductCart, VueSlickCarousel, Banner },
  data() {
    return {
      activeTabPanel: 'bestseller',
      allProducts: [],
      settings: {
        "autoplay":true,
        "autoplaySpeed":9000,
        "arrows":false,
        "dots":true,
        "dotsClass": "slick-dots",
        "infinite":true,
        "speed":1000,
        "slidesToShow": 1,
        "slidesToScroll": 1,
        responsive: [
          {breakpoint: 2000, settings: {slidesToShow: 1}}
        ]
      },
      productsSettings: {
        "autoplay":false,
        "autoplaySpeed":1000,
        "arrows":false,
        "dots":true,
        "dotsClass": "slick-dots",
        "infinite":false,
        "speed":800,
        "slidesToShow": 4,
        "slidesToScroll": 1,
        responsive: [
          {"breakpoint":2000, "settings":{"slidesToShow":4}},
          {"breakpoint":1200, "settings":{"slidesToShow":3}},
          {"breakpoint":992, "settings":{"slidesToShow":2}},
          {"breakpoint":480, "settings":{"slidesToShow":2}}
        ]
      },
      instagramSettings: {
        "autoplay":false,
        "autoplaySpeed":1000,
        "arrows":false,
        "dots":false,
        "infinite":true,
        "speed":800,
        "slidesToShow": 5,
        "slidesToScroll": 1,
        responsive: [
          {"breakpoint":2000, "settings":{"slidesToShow":5}},
          {"breakpoint":1200, "settings":{"slidesToShow":4}},
          {"breakpoint":992, "settings":{"slidesToShow":3}},
          {"breakpoint":768, "settings":{"slidesToShow":2}},
          {"breakpoint":481, "settings":{"slidesToShow":2}}
        ]
      },
    }
  },
  computed: {
    ...mapGetters({"design":"settings"}),
    styleObject: function() {
      return {
        '--bg-color': this.design ? this.design.main_color : null,
      }
    },
    mainProducts() {
      const slideItems = [
          {
            categoryId: 9,
            title: this.$t('assortment_watches'),
            avatar: require('@/assets/images/watch_2.webp'),
          },
          {
            categoryId: 2,
            title: this.$t('assortment_jewelry'),
            avatar: require('@/assets/images/10_2.webp'),
          },

      ]
      const bannerItems = [
        {
          categoryId: 2,
          avatar: require('@/assets/images/6_2.webp')
        },
        {
          categoryId: 2,
          avatar: require('@/assets/images/9.webp')
        },
      ]
      return {
        bannerItems: bannerItems,
        slideItems: slideItems
      }
    },
    bottomSlideProducts() {
      return [
        {
            categoryId: 9,
            avatar: require('@/assets/images/istockphoto-533714204-612x612.webp')
        },
        {
            categoryId: 13,
            avatar: require('@/assets/images/womens_sneakers.webp')
        },
      ]
    },
    dealDayProducts() {
      return this.$store.state.dealDayProducts
    },
    popularProducts() {
      return this.$store.state.popularProducts
    },
    topPanel() {
      return {
        bestseller: this.popularProducts?.filter(item => item.best_seller),
        newArrivals: this.popularProducts?.filter(item => item.new_arrival),
        topRated: this.popularProducts?.filter(item => item.top_rated),
      }
    }
  },
  created() {
    this.$store.dispatch('getDealDayProducts')
    this.$store.dispatch('getBestsellers')
  },
  methods: {
    viewProductPage(id) {
      this.$router.replace({name: 'Products', query: {'filter[categories]': [id]}})
    }
  }
}
</script>

<style>
.item-banner .banner-content > .button {
  padding: 0 20px;
}
.mainProducts_wrap > .banner:last-child {
  display: none;
}
.slider-item .price .number-price {
  font-size: 18px !important;
}
.instagram .slick-slide {
  padding: 0;
}
.custom-title {
  color: #FFFFFF;
  overflow: hidden;
  text-overflow: ellipsis;
  word-break: break-all;
  white-space: nowrap;
  margin: 0 0 20px;
  font-size: 16px !important;
}
.free-title {
  text-transform: uppercase!important;
}
/*.slider-infor{
  background-image: url("../assets/images/p_62a1ad065399f_1654762758.jpg");
}
.style7>.inner{
  background-image: url("../assets/images/p_629f28d1a45a6_1654597841.jpg") !important;
}*/
.custommenu-title-blog::before{
  border-bottom: 4px solid var(--bg-color)
}
.ysera-tabs .tab-link li.active a{
  color: var(--bg-color);
}
.ysera-tabs .tab-link li a:hover{
  color: var(--bg-color);
}
.instagram-wrapp .custommenu-title-blog i{
  color: var(--bg-color);
}
.item-banner .banner-content>.button {
  background: var(--bg-color) !important;
  border: 2px solid var(--bg-color) !important;
  color: white;
}

.slider-item .slider-infor .button{
  background: var(--bg-color) !important;
  border: 2px solid var(--bg-color) !important;
  padding: 0 20px;
}
.item-banner .button:hover{
  color: #fff !important;
  background: #000 !important;
  border-color: #000 !important;
}
.slider-item .title-big {
    max-width: 100%;
}
.slider-item.style9 .slider-inner .slider-infor {
    padding-right: 50px;
}
.slick-list {
    margin: 0 !important;
}
.slider-item .title-big {
    font-size: 18px;
}
.slider-item .price {
    color: #ffffff;
   font-size: 16px !important;
}
.home-slider-banner {
  margin-bottom: 10px;
}
.home-slider-banner .silider-wrapp {
    height: 295px;
}
.home-slider {
    height: 100%;
}
.home-slider div {
    height: 100%;
}
.slider-item.style9 .slider-inner .slider-infor {
    padding: 20px;
}
.slider-infor {
    width: 100% !important;
    height: auto !important;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -30%);
}

@media screen and (max-width: 1400px) {
    .home-slider-banner .silider-wrapp {
        height: 244px;
    }
    .slider-item.style9 .slider-inner .slider-infor {
        padding-bottom: 100px;
    }
    .item-banner.style7 .banner-content {
        padding: 115px;
    }
}
@media screen and (max-width: 1200px) {
  .mainProducts_wrap > .banner:last-child {
    display: block;
  }
}
@media screen and (max-width: 768px) {
    .slider-item.style9 .slider-inner .slider-infor {
        padding: 30px;
    }
    .slider-infor {
        transform: translate(-50%, -50%);
    }
}
</style>