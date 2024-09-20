<template>
    <div :style="styleObject" class="header-nav-container">
        <div class="container">
            <div class="header-nav-wapper main-menu-wapper">
                <div class="vertical-wapper block-nav-categori" @mouseleave="openCategories = false">
                    <div class="block-title-section">
                        <div v-for="item in categories" :key="item.id" class="block-title">
                            <a
                                class="ysera-menu-item-title ysera-menu-item-title-before"
                                @mouseenter="change(item.id)"
                                :class="{ 'hovered': openCategories && isOpenAfterDropdown === item.id }"
                                :title="item.name"

                            >
                                <span @mouseover="toggleSection(item.id)">{{ categoryName(item.name) }} </span>
                            </a>
                        </div>
                    </div>
                    <div
                        v-if="sub_categories.length"
                        class="block-content verticalmenu-content"
                        :class="{'show-up': openCategories}"
                    >
                        <div class="container container-items">
                            <ul v-for="sub in sub_categories" :key="sub.id"
                                class="ysera-nav-vertical vertical-menu ysera-clone-mobile-menu">
                                <li
                                    class="menu-item menu-item-categories"
                                    @click="openCategories = false"
                                >
                                    <a
                                        class="ysera-menu-item-title"
                                        :title="sub.name"
                                        @click="selectCategory(sub.id)"
                                    >
                                        {{ categoryName(sub.name) }}
                                    </a>
                                </li>
                                <li
                                    v-for="sub_sub in sub.sub_sections" :key="sub_sub.id"
                                    class="menu-item menu-item-sub-categories"
                                    @click="openCategories = false"
                                >
                                    <a
                                        class="ysera-menu-item-title"
                                        :title="sub_sub.name"
                                        @click="selectCategory(sub_sub.id)"
                                        :disabled="true"
                                    >
                                        {{ categoryName(sub_sub.name) }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!--        <div class="header-nav">-->
                <!--          <div class="container-wapper">-->
                <!--            <ul class="ysera-clone-mobile-menu ysera-nav main-menu " id="menu-main-menu">-->
                <!--              <li :class="['menu-item', item.children.length ? 'menu-item-has-children' : '']" v-for="item in nav" :key="item.id">-->
                <!--                <template>-->
                <!--                  <router-link :to="{name: item.view}" class="ysera-menu-item-title" :style="styleObject" :title="item.name">{{item.name}}</router-link>-->
                <!--                </template>-->
                <!--              </li>-->
                <!--            </ul>-->
                <!--          </div>-->
                <!--        </div>-->
            </div>
        </div>
    </div>
</template>

<script>
import headerMixin from "@/mixins/header.mixin";
import {mapGetters, mapMutations} from "vuex";

export default {
    name: "HeaderNav",
    data() {
        return {
            sub_categories: [],
            isOpenAfterDropdown: null,
        }
    },
    mixins: [headerMixin],
    computed: {
        ...mapGetters(["settings"]),
        styleObject: function () {
            return {
                '--bg-color': this.settings ? this.settings.main_color : 'white',
            }
        },
        categories() {
            return this.$store.state.categories
        }
    },
    methods: {
        ...mapMutations(["setCategory"]),
        change(id) {
            this.openCategories = id && this.sub_categories.length
            this.isOpenAfterDropdown = id
        },
        selectCategory(id) {
            this.setCategory([id])
            if (id != this.$route.query['filter[categories]']) {
                this.$router.replace({name: 'Products', query: {'filter[categories]': [id]}})
            }
        },
        toggleSection(id) {
            this.sub_categories = []
            this.categories.map(item => {
                if (item.id === id) {
                    item.sub_sections.map(sub => {
                        this.sub_categories.push(sub)
                    })
                    this.openCategories = true
                }
            })
        },
        categoryName(names) {
            return names[this.$i18n.locale]
        }
    }
}
</script>

<style lang="scss" scoped>
.container-items {
    display: flex;
}

.ysera-menu-item-title {
    position: relative;
    color: #757575;
    cursor: pointer;
    font: 500 16px knockout, helvetica, arial, sans-serif;
    letter-spacing: 1.8px;

    &:hover {
        color: var(--bg-color);
    }
}

.ysera-menu-item-title-before.hovered:before {
    content: "";
    display: block;
    height: 0;
    position: absolute;
    top: 40px;
    transition: visibility 0s, opacity .2s linear;
    transition-delay: .2s;
    width: 0;
    border: 11px solid #f000;
    border-top-color: #f3f3f3;
    left: calc(50% - 11px);
    z-index: 9999;
    opacity: 1;
    visibility: visible;
}

.ysera-menu-item-title-before.hovered:after {
    content: "";
    display: block;
    height: 0;
    position: absolute;
    top: 40px;
    transition: visibility 0s, opacity .2s linear;
    transition-delay: .2s;
    width: 0;
    border: 10px solid #0000;
    border-top-color: #f3f3f3;
    left: calc(50% - 10px);
    z-index: 99999;
    opacity: 1;
    visibility: visible;
}

.ysera-menu-item-title:hover {
    color: var(--bg-color);
}

.vertical-menu .menu-item a:hover {
    color: var(--bg-color);
}

.block-title-section {
    display: flex;
    width: 100%;
}
</style>