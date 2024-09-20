<template>
  <div class="captcha-wrapper">
    <form>
      <vue-recaptcha
          :sitekey="captchaKey"
          @verify="onCaptchaVerify"
      />
    </form>
  </div>
</template>

<script>
import { VueRecaptcha } from 'vue-recaptcha'
export default {
  name: 'captcha-component',
  components: {
    VueRecaptcha
  },
  props: ['form'],
  data: () => ({
    captchaKey: process.env.VUE_APP_CAPTCHA
  }),

  methods: {
    onCaptchaVerify(token) {
      this.$emit('verify', token)
    },
  }
}
</script>

<style lang="scss" scoped>
.captcha-wrapper{

}
</style>