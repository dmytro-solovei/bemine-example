<template>
  <div class="breadcrumb-trail breadcrumbs">
    <ul class="trail-items breadcrumb">
      <li class="trail-item trail-begin">
        <router-link :to="{name: 'Home'}">{{ $t('mainPage') }}</router-link>
      </li>
      <li class="trail-item trail-end active">
        {{currentRouteName}}
      </li>
    </ul>
  </div>
</template>

<script>

export default {
  name: "Breadcrumbs",
  computed: {
    currentRouteName() {
      switch (this.$route.name) {
        case 'About':
          return this.$t('about');
        case 'Checkout':
          return this.$t('orderPage');
        case 'WishList':
          return this.$t('wishList');
        case 'ShoppingCart':
          return this.$t('shoppingCart');
        case 'Products':
          return this.$t('allProducts');
        case 'Product':
          return this.$t('product');
        default:
          return this.$route.name
      }
    }
  }
}
</script>

<style scoped>

</style>