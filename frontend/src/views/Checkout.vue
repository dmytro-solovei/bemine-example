<template>
  <div class="main-content main-content-checkout">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <Breadcrumbs/>
        </div>
      </div>
      <h3 class="custom_blog_title">
          {{ $t('orderPage') }}
      </h3>
      <div class="checkout-wrapp">
        <div v-if="!showSuccess" class="shipping-address-form-wrapp" :style="styleObject">
          <div class="shipping-address-form  checkout-form">
            <div class="row-col-1 row-col">
              <div class="shipping-address">
                <h3 class="title-form">
                    {{ $t('shipping_Information') }}
                </h3>
                <div class="row-wrap">
                  <div class="form-row form-row-first">
                    <label class="text">{{ $t('name') }}</label>
                    <input
                        v-model="form.name"
                        title="first"
                        type="text"
                        class="input-text"
                        :class="{'input-error': errors.name}"
                    >
                    <p class="error-text" v-if="errors.name">{{ $t('necessarily') }}</p>
                  </div>
                  <div class="form-row form-row-last">
                    <label class="text">{{ $t('phone') }}</label>
                    <input
                        v-model="form.phone"
                        title="phone"
                        type="text"
                        class="input-text"
                        :class="{'input-error': errors.phone}"
                    >
                    <p class="error-text" v-if="phoneInvalid">{{ $t('incorrect_format') }}</p>
                    <p class="error-text" v-else-if="errors.phone">{{ $t('necessarily') }}</p>
                  </div>
                </div>
                <div class="row-wrap">
                  <div class="form-row form-row-last">
                    <label class="text">{{ $t('address') }}</label>
                    <input
                        v-model="form.address"
                        title="address"
                        type="text"
                        class="input-text"
                        :class="{'input-error': errors.address}"
                    >
                    <p class="error-text" v-if="errors.address">{{ $t('necessarily') }}</p>
                  </div>
                  <div class="form-row form-row-first">
                    <label class="text">{{ $t('postal_code') }}</label>
                    <input
                        v-model="form.zipCode"
                        title="zip"
                        type="text"
                        class="input-text"
                        :class="{'input-error': errors.zipCode}"
                    >
                    <p class="error-text" v-if="errors.zipCode">{{ $t('necessarily') }}</p>
                  </div>
                </div>
                <CaptchaComponent :form="form" @verify="verifyHandler" />
                <p class="error-text" v-if="errors.token">{{ $t('necessarily') }}</p>

                <p v-if="errorFromBack" class="error-text">{{errorFromBack}}</p>
              </div>
            </div>
            <div class="row-col-2 row-col">
              <div class="your-order">
                <h3 class="title-form">
                    {{ $t('your_order') }}
                </h3>
                <ul class="list-product-order">
                  <li
                      v-for="(product, i) in shopProducts"
                      :key="i"
                      class="product-item-order"
                  >
                    <div class="product-thumb">
                      <router-link :to="{name: 'Product', params: {slug: product.slug}}">
                        <img :src="product.avatar" alt="img">
                      </router-link>
                    </div>
                    <div class="product-order-inner">
                      <h5 class="product-name">
                        <router-link :to="{name: 'Product', params: {slug: product.slug}}" class="title">{{product.title}}</router-link>
                      </h5>
                      <span class="attributes-select attributes-color">{{product.color.name}},</span>
                      <span class="attributes-select attributes-size">{{product.size.name}}</span>
                      <div class="price">
                        {{product.price}} {{design ? design.currency_value : null }}
                        <span class="count">({{product.count}} {{ $t('piece') }})</span>
                      </div>
                    </div>
                  </li>
                </ul>
                <div class="order-total">
									<span class="title">
										{{ $t('total_cost') }}
									</span>
                  <span class="total-price">
                      {{cartTotalPrice}} {{design ? design.currency_value : null }}
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="button button-payment" @click="orderHandler" :style="styleObject">{{ $t('confirm_order') }}</div>
        </div>
        <div v-if="showSuccess" class="end-checkout-wrapp">
          <div class="end-checkout checkout-form">
            <div class="icon">
              <span class="flaticon-checked"></span>
            </div>
            <h3 class="title-checkend">
                {{ $t('congratulations_registered') }}
            </h3>
            <div class="sub-title">
                {{ $t('will_contact_you_within_a_very_short_period_of_time') }}
            </div>
            <router-link to="/products" class="button btn-return">{{ $t('go_back_to_the_list') }}</router-link>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Breadcrumbs from "@/components/Breadcrumbs";
import { http } from '@/api/http-common';
import CaptchaComponent from "@/components/Captcha.vue";
import {mapGetters} from "vuex";

export default {
  name: "Checkout",
  components: {CaptchaComponent, Breadcrumbs},
  data() {
    return {
      errorFromBack: "",
      showSuccess: false,
      form: {
        name: "",
        phone: "",
        address: "",
        zipCode: "",
        token: ""
      },
      errors: {
        name: false,
        phone: false,
        address: false,
        zipCode: false,
        token: false,
      },
      phoneInvalid: false
    }
  },
  computed: {
    shopProducts() {
      return this.$store.state.shopProducts
    },
    cartTotalPrice() {
      return this.$store.state.cartTotalPrice
    },
      ...mapGetters({"design": "settings"}),
      styleObject: function () {
        return {
          '--bg-color': this.design ? this.design.main_color : null,
        }
      }
  },
  watch: {
    'form.name'(){
      this.errors.name = false
    },
    'form.phone'(val){
      // const regex =  /^([0-9]{2,3})?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/
      const regex =  /^[0-9-+() ]*$/
      this.phoneInvalid = val.match(regex) === null && val.length || val.length > 20

      this.errors.phone = false
    },
    'form.address'(){
      this.errors.address = false
    },
    'form.zipCode'(){
      this.errors.zipCode = false
    },
    'form.token'(){
      this.errors.token = false
    },
  },
  created() {
    this.$store.dispatch('getShopProducts')
  },
  methods: {
    verifyHandler(token) {
      this.form.token = token;
    },
    orderHandler() {
      for(let key in this.form) {
          this.errors[key] = !this.form[key];
      }
      if(Object.values(this.errors).includes(true)) return;
      const orders = []
      this.shopProducts.forEach(item => {
        let product = {
          id: item.id,
          count: item.count,
          size: item.size.id,
          color: item.color.id,
        }
        orders.push(product)
      })
      const data = {
        ...this.form,
        orders
      }
      http.post("/order", data)
      .then(() => {
        this.showSuccess = true;
        localStorage.removeItem('shopProducts');
        this.$store.dispatch('getShopProducts');
        this.$store.commit("setShopProducts", JSON.parse(localStorage.getItem("shopProducts")))
        this.errorFromBack = ""
      })
      .catch(err => {
        this.errorFromBack = err.response?.data.message
      })
    }
  }
}
</script>

<style scoped lang="scss">
.error-text {
  color: #e80c0c;
  margin: 0;
}
.input-error {
  border: 1px solid #e80c0c;
}
.title-form::before{
  border: 1px solid var(--bg-color) !important ;
}
.button-payment:hover{
 background: var(--bg-color) !important ;
}
.row-wrap {
  width: 100%;
  display: flex;
  justify-content: space-between;

  @media(max-width: 480px) {
    flex-direction: column;
  }
}
</style>
