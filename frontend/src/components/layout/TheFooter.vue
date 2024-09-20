<template>
    <div>
        <footer class="footer style7">
            <div class="container">
                <div class="container-wapper">
                    <div class="footer-end">
                        <div class="row footer-content">
                            <div class="col-sm-12 col-xs-12 col-md-12 site-info-content">
                                <div class="site-info">
                                    <ul>
                                        <li>
                                            <a href="/">{{ $t('mainPage') }}</a>
                                        </li>
                                        <li>
                                            <a href="/about">{{ $t('about') }}</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="ysera-socials">
                                    <ul class="socials" :style="styleObject">
                                        <li>
                                            <a href="#" class="social-item" target="_blank">
                                                <i class="icon fa fa-facebook"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="https://www.instagram.com/jewelleryshop_bemine/"
                                               class="social-item" target="_blank">
                                                <i class="icon fa fa-instagram"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="coppyright">
                        Copyright © {{ new Date().getFullYear() }}
                        <router-link to="/" :style="{'color': settings ? settings.main_color : 'white'}">
                            BeMine
                        </router-link>
                        . All rights reserved
                    </div>
                </div>
            </div>
        </footer>
        <FooterMobile/>
    </div>
</template>

<script>
import FooterMobile from "@/components/layout/footer/FooterMobile";
import {mapGetters} from "vuex";

export default {
    name: "TheFooter",
    components: {FooterMobile},
    computed: {
        ...mapGetters(["settings"]),
        styleObject: function () {
            return {
                '--bg-color': this.settings ? this.settings.main_color : 'white',
            }
        },
    }
}
</script>

<style>
a:hover {
    color: var(--bg-color) !important;
}

.footer-content {
    display: flex;
    justify-content: center;
}
.site-info-content {
    display: flex;
    justify-content: center;
    align-items: center;
}
.site-info {
    display: flex;
    justify-content: flex-end;
    margin-right: 20px;
}

.site-info ul {
    list-style: none;
    display: flex;
}
.site-info ul li {
    margin: 0 10px;
}
.site-info ul li a {
    color: #888888;
}
</style>