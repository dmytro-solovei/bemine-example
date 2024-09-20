<template>
  <div class="about">
    <div class="main-content main-content-about">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <Breadcrumbs/>
          </div>
        </div>
        <div class="row">
          <div class="content-area content-about col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="site-main">
              <h3 class="custom_blog_title">{{ $t('aboutUs') }}</h3>
              <div class="page-main-content">
                <div class="header-banner banner-image">
                  <div class="banner-wrap">
                    <div class="banner-header">
                      <div class="col-lg-5 col-md-offset-7">
                        <div class="content-inner">
                          <h2 class="title" :style="{'color': design ? design.main_color : null}">
                            {{ $t('newAssortment') }} <br/> {{$t('forYou')}}
                          </h2>
                          <div class="sub-title">
                            {{$t('unique_text1')}} <br/>
                            {{$t('unique_text2')}}
                          </div>
                          <router-link to="/products" class="ysera-button button" :style="styleObject">{{ $t('buy') }}</router-link>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row"  :style="styleObject">
                  <div class="col-lg-3 col-md-4 col-sm-4" >
                    <div class="ysera-iconbox  layout1">
                      <div class="iconbox-inner">
                        <div class="icon-item">
                          <span class="placeholder-text">01</span>
                          <span class="icon flaticon-delivery-truck"></span>
                        </div>
                        <div class="content">
                          <h4 class="title">
                            {{$t('freeDelivery')}}
                          </h4>
                          <div class="text">
                            {{$t('freeDeliveryText')}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-1">
                    <div class="ysera-iconbox  layout1">
                      <div class="iconbox-inner">
                        <div class="icon-item">
                          <span class="placeholder-text">02</span>
                          <span class="icon flaticon-diamond"></span>
                        </div>
                        <div class="content">
                          <h4 class="title">
                            {{$t('style')}}
                          </h4>
                          <div class="text">
                            {{$t('styleText')}}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-3 col-md-4 col-sm-4 col-lg-offset-1">
                    <div class="ysera-iconbox  layout1">
                      <div class="iconbox-inner">
                        <div class="icon-item">
                          <span class="placeholder-text">03</span>
                          <span class="icon flaticon-support"></span>
                        </div>
                        <div class="content">
                          <h4 class="title">
                            {{ $t('onlineService') }}
                          </h4>
                          <div class="text">
                            {{ $t('onlineServiceText') }}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumbs from "@/components/Breadcrumbs";
import {mapGetters} from "vuex";
export default {
  name: 'About',
  components: {Breadcrumbs},
  data() {
    return {
      settings: {
        "autoplay":false,
        "autoplaySpeed":1000,
        "arrows":true,
        "dots":false,
        "infinite":true,
        "speed":800,
        "slidesToShow": 3,
        "slidesToScroll": 1,
        responsive: [
          {"breakpoint": 480, "settings":{"slidesToShow":1}},
          {"breakpoint": 767, "settings":{"slidesToShow":2}},
          {"breakpoint": 2000, "settings":{"slidesToShow":3}}
        ]
      }
    }
  },
  computed: {
    ...mapGetters({design:"settings"}),
    styleObject: function() {
      return {
        '--bg-color': this.design ? this.design.main_color : null,
      }
    }
    },
}
</script>
<style>
.header-banner .ysera-button.button{
  background: var(--bg-color);
  border-color:var(--bg-color) ;
  color: white !important;
}
.ysera-iconbox.layout1 .icon-item .icon{
  color:var(--bg-color) ;
}
</style>