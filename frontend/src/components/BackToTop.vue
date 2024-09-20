<template>
  <a href="javascript:void(0)" class="backtotop" :class="{'show': backToTop}" @click.prevent="scrollToTop" :style="styleObject">
    <i class="fa fa-angle-double-up" ></i>
  </a>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: "BackToTop",
  data() {
    return {
      backToTop: false
    }
  },
  mounted() {
    window.addEventListener('scroll', () => {
      window.scrollY > 1000 ? this.backToTop = true : this.backToTop = false
    })
  },
  methods: {
    scrollToTop() {
      this.$smoothScroll({scrollTo: document.body})
    }
  },
  computed:{
    ...mapGetters({"settings":"settings"}),
    styleObject: function() {
      return {
        '--bg-color': this.settings ? this.settings.main_color : null,
      }
    }
  }
}
</script>
<style>
.backtotop:hover{
 background: var(--bg-color) !important;
}
</style>
