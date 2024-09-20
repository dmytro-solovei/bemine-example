<template>
  <div>
    <header class="header style7 the-header">
      <TopBar/>
      <div class="container">
        <HeaderMain/>
      </div>
      <HeaderNav class="rows-space-20"/>
    </header>
    <HeaderMobile/>
  </div>
</template>

<script>
import HeaderMobile from "@/components/layout/header/HeaderMobile";
import TopBar from "@/components/layout/header/TopBar";
import HeaderMain from "@/components/layout/header/HeaderMain";
import HeaderNav from "@/components/layout/header/HeaderNav";
export default {
  name: "TheHeader",
  components: {HeaderNav, HeaderMain, TopBar, HeaderMobile},
}
</script>