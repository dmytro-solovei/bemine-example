<template>
  <div class="site-content">
    <main class="site-main  main-container no-sidebar">
      <div class="container">
        <Breadcrumbs/>
        <div class="row">
          <div class="main-content-cart main-content col-sm-12">
            <h3 class="custom_blog_title">
                {{ $t('cart_empty') }}
            </h3>
            <div class="page-main-content">
              <div class="shoppingcart-content">
                <form action="shoppingcart.html" class="cart-form">
                  <table v-if="shopProducts.length" class="shop_table">
                    <thead>
                    <tr>
                      <th class="product-remove"></th>
                      <th class="product-thumbnail"></th>
                      <th class="product-name"></th>
                      <th class="product-price"></th>
                      <th class="product-quantity"></th>
                      <th class="product-subtotal"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(prod, idx) in shopProducts" :key="idx" class="cart_item">
                      <td class="product-remove" :style="styleObject">
                        <a class="remove" @click="showDeletePopup = idx"></a>
                      </td>
                      <td class="product-thumbnail">
                        <a>
                          <img :src="prod.avatar" alt="img"
                               class="attachment-shop_thumbnail size-shop_thumbnail wp-post-image">
                        </a>
                      </td>
                      <td class="product-name" data-title="Product">
                        <router-link :to="{name: 'Product', params: {slug: prod.slug}}" class="title">{{prod.title}}</router-link>
                        <span class="attributes-select attributes-color">{{prod.color.name}},</span>
                        <span class="attributes-select attributes-size">{{prod.size.name}}</span>
                      </td>
                      <td class="product-quantity" data-title="Quantity">
                        <div class="quantity">
                          <div class="control">
                            <a class="btn-number qtychange qtyminus quantity-minus" @click="changeCount(idx, -1)">-</a>
                            <input v-model="prod.count" disabled type="text" data-step="1" data-min="0" title="Qty" class="input-qty qty" size="4">
                            <a class="btn-number qtychange qtyplus quantity-plus" @click="changeCount(idx, +1)">+</a>
                          </div>
                        </div>
                      </td>
                      <td class="product-price" data-title="Price">
													<span class="woocommerce-Price-amount amount">
														{{prod.price}}
                            <span class="woocommerce-Price-currencySymbol">
															{{settings ? settings.currency_value : null }}
														</span>
													</span>
                      </td>
                    </tr>
                    <tr>
                      <td class="actions">
<!--                        <div class="coupon">-->
<!--                          <label class="coupon_code">Coupon Code:</label>-->
<!--                          <input type="text" class="input-text" placeholder="Promotion code here">-->
<!--                          <a href="#" class="button"></a>-->
<!--                        </div>-->
                        <div class="order-total">
                          <span class="title">{{ $t('total_cost') }}</span>
                          <span class="total-price"> {{cartTotalPrice}} {{settings ? settings.currency_value : null }}</span>
                        </div>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </form>
                <div class="control-cart" :style="styleObject">
                  <button class="button btn-continue-shopping" @click="$router.push({name: 'Products'})">
                      {{ $t('continue_shopping') }}
                  </button>
                  <button
                      v-if="shopProducts.length"
                      class="button btn-cart-to-checkout"
                      @click="$router.push({ name: 'Checkout', params: { shopProducts: shopProducts }})"
                  >
                      {{ $t('buy_now') }}
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <DeletePopup
            v-if="showDeletePopup || showDeletePopup === 0"
            :fromCart="true"
            @confirm="removeHandler"
            @close="closeModal"
        />
      </div>
    </main>
  </div>
</template>

<script>
import Breadcrumbs from "@/components/Breadcrumbs";
import DeletePopup from "@/components/DeletePopup.vue";
import productMixin from "@/mixins/product.mixin";
import {mapGetters} from "vuex";
export default {
  name: "ShoppingCart",
  mixins: [productMixin],
  components: {Breadcrumbs, DeletePopup},
  data() {
    return {
      showDeletePopup: false
    }
  },
  computed: {
    ...mapGetters({"settings":"settings"}),
    styleObject: function() {
      return {
        '--bg-color': this.settings ? this.settings.main_color : 'white',
      }
    },
    shopProducts() {
      return this.$store.state.shopProducts
    },
    cartTotalPrice() {
      return this.$store.state.cartTotalPrice
    },
  },
  created() {
    this.$store.dispatch('getShopProducts')
  },
  methods: {
    changeCount(idx, qty) {
      const products = JSON.parse(localStorage.getItem("shopProducts"))
      products.map((item, i) => {
        if(item.count === 1 && qty === -1) return;
        if(i === idx){
          item.count = parseInt(item.count) + parseInt(qty)
        }
      })
      localStorage.setItem('shopProducts', JSON.stringify(products))
      this.$store.dispatch('getShopProducts')
    },
    closeModal() {
      this.showDeletePopup = false
    },
    removeHandler() {
      this.removeCartItem(this.showDeletePopup)
      this.closeModal()
    },
  }
}
</script>

<style lang="scss" scoped>
.control-cart {
  button {
    margin-bottom: 10px;
  }
}
.btn-continue-shopping:hover{
  background: var(--bg-color) !important;
}
.btn-cart-to-checkout:hover{
  background: var(--bg-color) !important;
}
.cart-form .product-remove:hover a:before{
  color: var(--bg-color) !important;
}
</style>