<template lang="pug">
  .thailand-pdpa-alert(v-if="showAlert")
    button.thailand-pdpa-alert-close(@click="showAlert = false")
      close-icon

    .thailand-pdpa-alert-content
      p เราใช้คุกกี้เพื่อเพิ่มประสิทธิภาพและประสบการณ์ที่ดีในการใช้เว็บไซต์ ท่านสามารถศึกษารายละเอียดการใช้คุกกี้ได้ที่ 
        a(href="#") “นโยบายการใช้คุกกี้” 
        | และสามารถเลือกตั้งค่ายินยอมการใช้คุกกี้ได้โดยคลิก 
        a(href="#" @click.prevent="$store.commit('SHOW_SETTING', true)") “การตั้งค่าคุกกี้”
        | นโยบายการใช้คุกกี้

    .thailand-pdpa-alert-buttons
      button.button.thailand-pdpa-button.secondary(@click="$store.commit('SHOW_SETTING', true)") การตั้งค่าคุกกี้
      button.button.thailand-pdpa-button(@click="showAlert = false") ยินยอมทั้งหมด
</template>

<script>
import CloseIcon from 'vue-material-design-icons/Close'

export default {
  components: { CloseIcon },
  data: () => ({
    showAlert: true,
  })
}
</script>

<style lang="scss" scoped>
.thailand-pdpa {
  &-alert {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 0.5rem 1rem;
    background: #fff;
    z-index: 9998;

    @media screen and (max-width: 991px) {
      padding-top: 1rem;
      padding-bottom: 1rem;
    }

    @media screen and (min-width: 992px) {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    &-content {
      @media screen and (max-width: 991px) {
        padding-left: 0;
        padding-right: 1rem;
      }
  
      @media screen and (min-width: 992px) {
        padding-right: 1rem;
        padding-left: 3rem;
      }
    }

    &-buttons {
      white-space: nowrap;

      @media screen and (max-width: 991px) {
        padding-top: 1rem;
        text-align: center;
      }

      .button {
        display: inline-block;

        @media screen and (min-width: 992px) {
          &:not(:first-child) {
            margin-left: 0.5rem;
          }
        }

        @media screen and (max-width: 991px) {
          margin: 0 0.25rem;
        }
      }
    }

    &-close {
      position: absolute;
      width: 2.5rem;
      top: 0;
      padding: 0;
      color: #000 !important;
      border: none !important;
      background: transparent !important;

      @media screen and (max-width: 991px) {
        top: 16px;
        right: 0;
      }

      @media screen and (min-width: 992px) {
        bottom: 0;
        left: 0;
        border-right: solid 1px #dee2e6 !important;
      }

      span {
        width: 20px;
        height: 20px;
        padding: 0;
        margin: 0 auto;
        display: block;
        opacity: 0.5;
      }

      &:hover {
        span {
          opacity: 1;
          color: var(--tpdpa-primary) !important;;
        }
      }

      svg {
        width: 20px;
        height: 20px;
        display: block;
      }
    }
  }
}
</style>
