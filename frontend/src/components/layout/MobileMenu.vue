<template>
    <transition-group name="slide">
        <div
            v-if="open"
            key="slide"
            class="ysera-menu-clone-wrap open"
            style="overflow: hidden"
            v-click-outside="closeMenu"
        >
            <div class="ysera-menu-panels-actions-wrap">
                <a v-if="historyMenu.length" class="ysera-menu-prev-panel" href="javascript:void(0)"
                   @click="goBack"></a>
                <span class="ysera-menu-current-panel-title">{{ titleMenu }}</span>
                <a class="ysera-menu-close-btn ysera-menu-close-panels" href="javascript:void(0)"
                   @click="closeMenu">x</a>
            </div>
            <MobileMenuItems
                v-for="(items, index) in categories"
                :key="index"
                :menu="items"
                @closeMenu="closeMenu"
            />
        </div>
    </transition-group>
</template>

<script>
import {bus} from '@/main'
import MobileMenuItems from '../MobileMenuItems.vue'
import {mapMutations} from "vuex";

export default {
  name: "MobileMenu",
    components: {
        MobileMenuItems
    },
  data() {
    return {
      open: false,
      key: 1,
      historyMenu: [],
      titleMenu: 'BeMine',
      langs: ['en', 'ru','am']
    }
  },
  mounted() {
    bus.$on('open-menu', this.openMenu)
  },
    computed: {
        categories() {
            return this.$store.state.categories
        }
    },
  methods: {
      ...mapMutations(["setCategory"]),
    openMenu() {
      this.open = true
    },
    closeMenu() {
      this.open = false
    },
    goBack() {
      const obj = this.historyMenu.pop()
      this.titleMenu = obj.title
      // this.menu = obj.child
      this.key = !this.key
    }
  }
}
</script>

<style scoped>
.menu-item {
    padding: 10px;
    margin: 0;
}
.menu-item a {
    position: relative;
    color: #757575;
    cursor: pointer;
    font: 500 16px knockout, helvetica, arial, sans-serif;
    letter-spacing: 1.8px;
}
</style>
