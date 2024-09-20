import Vue from 'vue'
import VueI18n from 'vue-i18n'

import {messages} from "@/i18/lang";

Vue.use(VueI18n)

export default new VueI18n({
    locale: localStorage.lang ? localStorage.lang : 'en',
    messages
});