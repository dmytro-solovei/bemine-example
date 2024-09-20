<template>
  <div class="footer-device-mobile">
    <div class="wapper">
      <div class="footer-device-mobile-item device-home">
        <router-link :to="{name: 'Home'}">
					<span class="icon">
						<i class="fa fa-home" aria-hidden="true"></i>
					</span>
          Home
        </router-link>
      </div>
      <div class="footer-device-mobile-item device-home device-cart device-wishlist">
        <router-link :to="{name: 'WishList'}">
					<span class="icon">
						<i class="fa fa-heart" aria-hidden="true"></i>
            <span class="count-icon" :style="{'background-color': settings ? settings.main_color : 'white'}">
							{{wishListCount}}
						</span>
					</span>
          Wishlist
        </router-link>
      </div>
      <div class="footer-device-mobile-item device-home device-cart">
        <router-link :to="{name: 'ShoppingCart'}">
					<span class="icon">
						<i class="fa fa-shopping-basket" aria-hidden="true"></i>
						<span class="count-icon" :style="{'background-color': settings ? settings.main_color : 'white'}">
							{{shopCartCount}}
						</span>
					</span>
          <span class="text">Cart</span>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: "FooterMobile",
  computed: {
    ...mapGetters(["settings"]),
    shopCartCount() {
      return this.$store.state.shopProducts?.length ?
          this.$store.state.shopProducts.length :
          JSON.parse(localStorage.getItem("shopProducts")) ?
              JSON.parse(localStorage.getItem("shopProducts")).length : 0
    },
    wishListCount() {
      return this.$store.state.wishList?.length ?
          this.$store.state.wishList.length :
          JSON.parse(localStorage.getItem("wishList")) ?
              JSON.parse(localStorage.getItem("wishList")).length : 0
    },
  }
}
</script>
