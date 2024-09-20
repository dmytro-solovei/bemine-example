<template>
<!--  <div class="top-bar" :style="{'background-color': settings ? settings.main_color : 'white'}">-->
<!--    <div class="container">-->
<!--      <div class="top-bar-left">-->
<!--        <div class="header-message">-->
<!--          {{ $t('welcome') }}-->
<!--        </div>-->
  <!--        <select v-model="$i18n.locale" @change="changeLocale($i18n.locale)" class="language">-->
  <!--          <option-->
  <!--              v-for="(lang, i) in langs"-->
  <!--              :key="`lang-${i}`"-->
  <!--              :value="lang"-->
  <!--          >-->
  <!--            {{ lang }}-->
  <!--          </option>-->
  <!--        </select>-->
<!--      </div>-->
<!--    </div>-->
<!--  </div>-->
  <div id="gh-top" class="gh-hide-if-nocss" role="navigation" aria-label="Account">
    <div>
    <ul id="gh-topl">
      <li class="gh-t gh-divider-l" id="gh-p-3">
        <a href="#" _sp="m570.l1545" data-sp="m570.l1545" class="gh-p"> {{$t('help_contact')}}</a>
      </li>
    </ul>
    <ul id="gh-eb">
      <select v-model="$i18n.locale" @change="changeLocale($i18n.locale)" class="language">
        <option
            v-for="(lang, i) in langs"
            :key="`lang-${i}`"
            :value="lang.name"
        >
         {{ lang.name.toLocaleUpperCase() }}
        </option>
      </select>
<!--      <li id="gh-p-2" class="gh-eb-li gh-t-rt gh&#45;&#45;link__divider rt">-->
<!--        <a href="https://www.ebay.com/sl/sell" _sp="m570.l1528" data-sp="m570.l1528" class="gh-p">-->

<!--        </a>-->
<!--      </li>-->
<!--      <li id="gh-wl-click" class="gh-eb-li gh-margin rt">-->
<!--        <div class="gh-menu gh&#45;&#45;link__divider">-->
<!--          <a href="https://www.ebay.com/mye/myebay/watchlist" _sp="m570.l47137" title="Watchlist" class="gh-eb-li-a gh-rvi-menu watchlist-menu">Watchlist-->
<!--          <i class="gh-sprRetina gh-eb-arw gh-rvi-chevron" data-sp="m570.l47137"></i>-->
<!--        </a>-->
<!--          <a href="#gh-wl-click" role="button" aria-expanded="false" data-controltarget="gh-wl-click-o" class="gh-acc-exp-a gh-acc-a2 gh-control">Expand Watch List</a>-->
<!--          <div class="gh-sublayer gh-flyout__menu" id="gh-wl-click-flyout" role="dialog" aria-label="Watchlist" style="display: block; width: auto; right: 0px; left: auto;">-->
<!--            <button id="gh-wl-click-close" class="gh_flyout__close" aria-label="Close dialog">-->
<!--              <svg aria-hidden="true" focusable="false" height="17" width="17"><use xlink:href="#icon-close"></use></svg>-->
<!--            </button>-->
<!--            <div id="gh-wl-click-body">-->
<!--              <div class="gh-loading">-->
<!--                <span class="gh-spinner" aria-label="Loading" role="img"></span>-->
<!--                <span class="gh-state">Loading...</span>-->
<!--              </div>-->
<!--              <div class="gh-wl-click-gen-error">-->
<!--                <span>-->
<!--                  <a href="https://signin.ebay.com/ws/eBayISAPI.dll?SignIn&amp;ru=ru">Sign in</a> to see your user information</span>-->
<!--              </div>-->
<!--            </div>-->
<!--          </div>-->
<!--          <div id="gh-wl-click-mask" class="gh-flyout__mask">-->

<!--          </div>-->
<!--        </div>-->
<!--      </li>-->
<!--      <li id="gh-eb-My" class="gh-eb-li gh-dd rt" data-imp="10">-->
<!--        <div class="gh-menu">-->
<!--          <a href="https://www.ebay.com/mys/home?source=GBH" _sp="m570.l2919" title="My eBay" class="gh-eb-li-a gh-rvi-menu">My eBay-->
<!--            <i class="gh-sprRetina gh-eb-arw gh-rvi-chevron" data-sp="m570.l2919"></i>-->
<!--          </a>-->
<!--          <a href="#gh-eb-My" role="button" aria-expanded="false" data-controltarget="gh-eb-My-o" class="gh-acc-exp-a gh-acc-a2 gh-control">Expand My eBay</a>-->
<!--          <div class="gh-submenu gh-eb-o" id="gh-eb-My-o" style="display: none;">-->
<!--            <ul role="navigation" id="gh-ul-nav">-->
<!--            <li>-->
<!--              <a href="https://www.ebay.com/mye/myebay/summary" _sp="m570.l1533" data-sp="m570.l1533" class="gh-eb-oa thrd"> Summary</a>-->
<!--            </li>-->
<!--              <li>-->
<!--                <a href="https://www.ebay.com/mye/myebay/rvi" _sp="m570.l9225" data-sp="m570.l9225" class="gh-eb-oa thrd"> Recently Viewed</a>-->
<!--              </li>-->
<!--              <li>-->
<!--                <a href="https://www.ebay.com/mye/myebay/v2/bidsoffers" _sp="m570.l1535" data-sp="m570.l1535" class="gh-eb-oa thrd"> Bids/Offers</a>-->
<!--              </li>-->
<!--              <li>-->
<!--                <a href="https://www.ebay.com/mye/myebay/watchlist" _sp="m570.l1534" data-sp="m570.l1534" class="gh-eb-oa thrd"> Watchlist</a>-->
<!--              </li>-->
<!--              <li>-->
<!--                <a href="https://www.ebay.com/mye/myebay/purchase" _sp="m570.l1536" data-sp="m570.l1536" class="gh-eb-oa thrd"> Purchase History</a>-->
<!--              </li>-->
<!--              <li id="gh_buyagain">-->
<!--                <a href="https://www.ebay.com/mye/buyagain" _sp="m570.l47010" data-sp="m570.l47010" class="gh-eb-oa thrd"> Buy Again</a>-->
<!--              </li>-->
<!--              <li>-->
<!--                <a href="https://www.ebay.com/mys/home?CurrentPage=MyeBayAllSelling&amp;ssPageName=STRK:ME:LNLK:MESX&amp;source=GBH" _sp="m570.l1537" data-sp="m570.l1537" class="gh-eb-oa thrd"> Selling</a>-->
<!--              </li>-->
<!--              <li>-->
<!--                <a href="https://www.ebay.com/myb/SavedSearches" _sp="m570.l9503" data-sp="m570.l9503" class="gh-eb-oa thrd"> Saved Searches</a>-->
<!--              </li>-->
<!--              <li>-->
<!--                <a href="https://www.ebay.com/myb/SavedSellers" _sp="m570.l9505" data-sp="m570.l9505" class="gh-eb-oa thrd"> Saved Sellers</a>-->
<!--              </li>-->
<!--              <li>-->
<!--                <a href="https://mesg.ebay.com/mesgweb/ViewMessages/0" _sp="m570.l1539" data-sp="m570.l1539" class="gh-eb-oa thrd"> Messages</a>-->
<!--              </li>-->
<!--              <li id="gh-eb-sub-li-cpn"></li>-->
<!--            </ul>-->
<!--          </div>-->
<!--        </div>-->
<!--      </li>-->
<!--      <li id="gh-eb-Alerts" class="gh-eb-li gh-layer rt">-->
<!--        <div class="gh-menu">-->
<!--          <button class="gh-control ghn-b gh-eb-li-a" aria-expanded="false" aria-controls="gh-eb-Alerts-o">-->
<!--            <i id="gh-Alerts-i" class="gh-sprRetina">Notification</i>-->
<!--          </button>-->
<!--          <div class="gh-sublayer">-->
<!--            <div id="gh-eb-Alerts-o" class="gh-eb-o" style="display: none;">-->

<!--            </div>-->
<!--          </div>-->
<!--        </div>-->
<!--      </li>-->
<!--      <li id="gh-minicart-hover" class="gh-eb-li gh-margin rt">-->
<!--        <div class="gh-menu">-->
<!--          <a href="https://cart.payments.ebay.com/sc/view" _sp="m570.l2633" data-sp="m570.l2633" class="gh-eb-li-a gh-rvi-menu" aria-label="Your shopping cart">-->
<!--            <svg focusable="false" class="gh-cart-icon" aria-hidden="true"><use xlink:href="#icon-cart-new"></use></svg>-->
<!--          </a>-->
<!--          <a href="#gh-minicart-hover" role="button" aria-expanded="false" data-controltarget="gh-minicart-hover-o" class="gh-acc-exp-a gh-acc-a2 gh-control">Expand Cart</a>-->
<!--          <div class="gh-sublayer gh-flyout__menu" id="gh-minicart-hover-flyout" role="dialog" aria-label="Your shopping cart" aria-modal="true" style="display: block; width: auto; right: 0px; left: auto;">-->
<!--            <button id="gh-minicart-hover-close" class="gh_flyout__close" aria-label="Close dialog">-->
<!--              <svg aria-hidden="true" focusable="false" height="17" width="17"><use xlink:href="#icon-close"></use></svg>-->
<!--            </button><div id="gh-minicart-hover-body"><div class="gh-loading">-->
<!--            <span class="gh-spinner" aria-label="Loading" role="img"></span>-->
<!--            <span class="gh-state">Loading...</span>-->
<!--          </div>-->
<!--            <div class="gh-minicart-hover-gen-error">-->
<!--              <span>Something went wrong. View cart for details.</span>-->
<!--            </div>-->
<!--          </div>-->
<!--          </div>-->
<!--          <div id="gh-minicart-hover-mask" class="gh-flyout__mask"></div>-->
<!--        </div>-->
<!--      </li>-->
    </ul>
    </div>
  </div>
</template>

<script>
import headerMixin from "@/mixins/header.mixin";
import {mapGetters} from "vuex";


export default {
  name: "TopBar",
  mixins: [headerMixin],
  data() {
    return {
      langs: [
          {
              name: 'am',
              flug: '🇦🇲',
          },
          {
              name: 'en',
              flug: '🇺🇸',
          },
          {
              name: 'ru',
              flug: '🇷🇺',
          },
      ]
    }
  },
  computed:{
    ...mapGetters(["settings"]),
  },
  methods:{
    changeLocale(locale){
      localStorage.lang = locale
    }
  }
}
</script>

<style>

.top-bar-left{
  display: flex !important;
  justify-content: space-around;
}
.language{
  padding-right: 1px;
}
option{
  color: #000;
}
#gh-top{
  width: 100%;
  border-bottom: 1px solid #ccc;
  min-height: 18px;
  display: flex;
  justify-content: center;
}
#gh-top>div {
  display: flex;
  min-height: 100%;
  width: 1170px;
  justify-content: center;
  flex-wrap: wrap;

}
#gh-topl,#gh-eb{
  display: flex;
  justify-content: center;
  width: 50%;
  list-style: none;
  min-width: 300px;
  gap: 30px;
  font-family: "Helvetica Neue",Helvetica,Arial,Verdana,Sans-serif !important;
}

@media (max-width: 410px) {
  .top-bar-left {
    flex-direction: column;
    align-items: flex-start;
    list-style: none;

  }
}
</style>

