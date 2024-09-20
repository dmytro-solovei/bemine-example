<template>
  <div class="popup-wrapper">
    <div class="popup">
      <div class="popup-header">
        <h2>Համոզվա՞ծ եք</h2>
        <div class="glyph popup-close" @click="closeModal">
          <div class="glyph-icon flaticon-close"></div>
        </div>
      </div>
      <p class="popup-text">{{ $t('action_remove_specified_element') }}
        <span v-if="fromCart">{{ $t('from_basket') }}</span>
        <span v-else>{{ $t('from_favorites_list') }}</span>
        :</p>
      <div class="popup-footer" :style="styleObject">
        <button @click="$emit('confirm')" class="btn-ok">{{ $t('yes') }}</button>
        <button class="btn-cancel" @click="closeModal">{{ $t('no') }}</button>
      </div>
    </div>
  </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  props: {
    fromCart: {
      type: Boolean,
      default: false
    }
  },
  methods: {
    closeModal() {
      this.$emit("close")
    }
  },
  computed: {
    ...mapGetters({"design": "settings"}),
    styleObject: function () {
      return {
        '--bg-color': this.design ? this.design.main_color : null,
      }
    },
  },
}
</script>

<style lang="scss">
.btn-ok{
  background:var(--bg-color) !important ;
}
.popup-wrapper {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: rgba(34,34,34,.8);
  z-index: 1002;
  display: flex;
  justify-content: center;
  align-items: center;
}
.popup {
  position: relative;
  background-color: #FFFFFF;
  width: 400px;
  height: 200px;
  padding: 30px;
  border-radius: 8px;
}
.popup-header {
  width: 100%;
  display: flex;
  justify-content: space-between;
  margin-bottom: 15px;

  h2 {
    font-size: 24px;
    line-height: 28px;
    margin-bottom: 0;
  }
}
.popup-close {
  cursor: pointer;
}
.popup-text {
  font-size: 14px;
  font-weight: 500;
  margin-bottom: 15px;
}
.popup-footer {
  .btn-ok {
    margin-right: 10px;
  }
  .btn-cancel {
    background-color: #f9f9f9;
    color: #666;
  }
}

</style>