<template>
    <div>
       <div class="mobile-menu-items">
           <p class="menu-item" @click="toggleMenu">
               <a>{{ categoryName(menu.name) }}</a>
               <span class="toggleIcon">
                    {{ this.isOpen ? "—" : "＋" }}
                </span>
           </p>
           <p class="subMenu" ref="name">
               <a
                   v-for="item in menu.sub_sections"
                   :key="item.id"
                   @click="selectCategory(item.id)"
               >
                   {{ categoryName(item.name) }}
               </a>
           </p>
       </div>
    </div>
</template>

<script>
import {mapMutations} from "vuex";

export default {
    data() {
        return {
            isOpen: false,
        }
    },
    props: ["menu"],
    methods: {
        ...mapMutations(["setCategory"]),
        toggleMenu() {
            if (this.isOpen) {
                this.collapse();
            } else {
                this.expand();
            }
            this.isOpen = !this.isOpen;
        },
        collapse() {
            const name = this.$refs.name;
            name.style.height = 0;
        },
        expand() {
            const name = this.$refs.name;
            name.style.height = name.scrollHeight + "px";
        },
        selectCategory(id) {
            this.$emit('closeMenu')
            this.setCategory([id])
            this.$router.replace({name: 'Products', query: {'filter[categories]': [id]}})
        },
        categoryName(names) {
            return names[this.$i18n.locale]
        }
    },
}
</script>

<style scoped>
.mobile-menu-items .menu-item{
    margin: 0;
}
.menu-item {
    cursor: pointer;
    font-weight: bold;
    padding: 12px;
    transition: transform 0.2s;
    position: relative;
    display: flex;
    align-items: center;
}

.menu-item a {
    position: relative;
    color: #757575;
    cursor: pointer;
    font: 500 16px knockout, helvetica, arial, sans-serif;
    letter-spacing: 1.8px;
}

.menu-item:active {
    transform: translateY(4px);
    box-shadow: none;
}

.subMenu {
    margin: 0;
    transition: 0.25s;
    height: 0;
    overflow: hidden;
    line-height: 1.5;
    padding-left: 25px;
}

.subMenu a {
    position: relative;
    color: #757575;
    cursor: pointer;
    font: 500 16px knockout, helvetica, arial, sans-serif;
    letter-spacing: 1.8px;
    font-size: 14px;
    display: block;
    margin: 0 0 20px;
}

.toggleIcon {
    font-size: 1.5em;
    font-weight: bold;
    position: absolute;
    right: 20px;
    display: inline-block;
    line-height: 0.5;
    color: #666;
}

</style>