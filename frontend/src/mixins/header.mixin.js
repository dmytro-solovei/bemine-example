import {bus} from "@/main";

export default {
    data() {
        return {
            openLangMenu: false,
            openLoginRegister: false,
            openCart: false,
            openCategories: false,
            openSearchBar: false
        }
    },
    methods: {
        toggleLangMenu() { this.openLangMenu = !this.openLangMenu },
        hideLangMenu() { this.openLangMenu = false },
        toggleLoginRegister() { this.openLoginRegister = !this.openLoginRegister },
        hideLoginRegister() { this.openLoginRegister = false },
        toggleCart() { this.openCart = !this.openCart },
        hideCart() { this.openCart = false },
        toggleCategories() { this.openCategories = !this.openCategories },
        openMobileMenu() { bus.$emit('open-menu') }

    }
}