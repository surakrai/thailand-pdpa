<template lang="pug">
  transition(:name="`${popupType}`")
    .thailand-pdpa-setting(
      v-if="showSetting"
      :data-type="popupType"
      :data-position="sidebarPosition"
    )
      .thailand-pdpa-setting-container
        .thailand-pdpa-setting-content
          .thailand-pdpa-setting-header
            h5 Cookie Settings
            button(@click="$store.commit('SHOW_SETTING', false)")
              close-icon(fillColor="#000")

          .thailand-pdpa-setting-body
            .thailand-pdpa-customize
              .thailand-pdpa-form
                .thailand-pdpa-form-item
                  h3 รูปแบบ 
                  input#popupTypeModal(
                    type="radio"
                    value="modal"
                    v-model="popupType"
                  )
                  label(for="popupTypeModal") Modal 

                  input#popupTypeSidebar(
                    type="radio"
                    value="sidebar"
                    v-model="popupType"
                  )
                  label(for="popupTypeSidebar")  Sidebar

                .thailand-pdpa-form-item(v-if="popupType === 'sidebar'")
                  h3 ตำแหน่ง
                  input#sidebarLeft(
                    type="radio"
                    value="left"
                    v-model="sidebarPosition"
                  )
                  label(for="sidebarLeft") Left 

                  input#sidebarRight(
                    type="radio"
                    value="right"
                    v-model="sidebarPosition"
                  )
                  label(for="sidebarRight")  Right

                .thailand-pdpa-form-item
                  h3 สี

                  input(
                    type="color"
                    value=""
                    v-model="cssVars['--tpdpa-primary']"
                  )
                  label สีหลัก

                  input(
                    type="color"
                    v-model="cssVars['--tpdpa-secondary']"
                  )
                  label สีรอง


            h3 {{ intro.title }}
            div(v-html="intro.description")
            button.button.thailand-pdpa-button(
              v-if="!acceptAll"
              @click="onAcceptAll"
            ) ยินยอมทั้งหมด

            .thailand-pdpa-setting-manage
              h3 จัดการการตั้งค่าความยินยอม

              ul.thailand-pdpa-setting-manage-list
                li.thailand-pdpa-setting-manage-item(
                  v-for="(item, index) in items"
                  :key="index"
                  :class="{ 'is-open' : isOpen[index] }"
                )
                  .thailand-pdpa-setting-manage-header
                    .thailand-pdpa-setting-manage-title(@click="onToggle(index)") 
                      minus-icon(v-if="isOpen[index]")
                      plus-icon(v-else)
                      | {{ item.title }}

                    .thailand-pdpa-setting-form-switch
                      input(type="checkbox" :checked="item.checked" v-model="item.checked")


                  p.thailand-pdpa-setting-manage-description(v-if="isOpen[index]") {{ item.description }}

          .thailand-pdpa-setting-footer
            //- slot(name='footer') default footer
            button.button.thailand-pdpa-button(@click="$store.commit('SHOW_SETTING', false)") ยืนยันตัวเลือกของฉัน
        
      .thailand-pdpa-setting-backdrop(@click="$store.commit('SHOW_SETTING', false)")
</template>

<script>
import { mapState } from 'vuex'
import MinusIcon from 'vue-material-design-icons/Minus'
import PlusIcon from 'vue-material-design-icons/Plus'
import CloseIcon from 'vue-material-design-icons/Close'

export default {
  components: { MinusIcon, PlusIcon, CloseIcon },

  data: () => ({
    popupType: 'modal',
    acceptAll: false,
    isOpen: [true],
    sidebarPosition: 'left',
    intro: {
      title: 'ศูนย์การตั้งค่าความเป็นส่วนตัว',
      description: '<p>เมื่อคุณเข้าชมเว็บไซต์ใดก็ตาม ไซต์นั้นอาจจัดเก็บหรือดึงข้อมูลจากเบราว์เซอร์ของคุณ ส่วนใหญ่แล้วอยู่ในรูปแบบของคุกกี้ ข้อมูลนี้อาจเกี่ยวกับคุณ การตั้งค่าของคุณ อุปกรณ์ของคุณ หรือเพื่อช่วยให้ไซต์ทำงานอย่างที่คุณต้องการ ซึ่งมักเป็นข้อมูลที่ไม่สามารถระบุตัวตนของคุณได้โดยตรง แต่ช่วยให้คุณใช้งานเว็บตามความต้องการส่วนบุคคลได้มากยิ่งขึ้น คุณสามารถปฏิเสธไม่ให้คุกกี้บางประเภททำงานได้ คลิกที่หัวข้อประเภทอื่นๆ เพื่อดูข้อมูลเพิ่มเติมและเปลี่ยนการตั้งค่าเริ่มต้นของเรา อย่างไรก็ตาม คุณควรทราบว่าการบล็อกคุกกี้บางประเภทอาจส่งผลต่อการใช้งานไซต์และบริการที่เรามีให้ใช้งาน</p>'
    },
    items: [
      {
        checked: false,
        title: 'คุกกี้ที่จำเป็น',
        description: 'คุกกี้ประเภทนี้มีความจำเป็นต่อการทำงานของเว็บไซต์ เพื่อให้เว็บไซต์สามารถทำงานได้เป็นปกติ มีความปลอดภัย และทำให้ท่านสามารถเข้าใช้เว็บไซต์ได้ เช่น การ log in เข้าสู่เว็บไซต์ การยืนยันตัวตน ทั้งนี้ ท่านไม่สามารถปิดการใช้งานของคุกกี้ประเภทนี้ผ่านระบบของเว็บไซต์ของเราได้',
      },
      {
        checked: false,
        title: 'คุกกี้เพื่อการวิเคราะห์',
        description: 'คุกกี้ประเภทนี้จะเก็บข้อมูลการใช้งานเว็บไซต์ของท่าน เพื่อให้เราสามารถวัดผล ประเมิน ปรับปรุง และพัฒนาเนื้อหาสินค้า/บริการและเว็บไซต์ของเราเพื่อเพิ่มประสบการณ์ที่ดีในการใช้เว็บไซต์ของท่าน ทั้งนี้ หากท่านไม่ยินยอมให้เราใช้คุกกี้ประเภทนี้ เราจะไม่สามารถวัดผล ประเมิน และพัฒนาเว็บไซต์ได้',
      },
      {
        checked: false,
        title: 'คุกกี้เพื่อปรับเนื้อหาให้เข้ากับกลุ่มเป้าหมาย',
        description: 'คุกกี้ประเภทนี้จะเก็บข้อมูลต่าง ๆ ซึ่งอาจรวมถึงข้อมูลส่วนบุคคลของท่านและสร้างโปรไฟล์เกี่ยวกับตัวท่าน เพื่อให้เราสามารถวิเคราะห์และนำเสนอเนื้อหา สินค้า/บริการ และ/หรือ โฆษณาที่เหมาะสมกับความสนใจของท่านได้ ทั้งนี้ หากท่านไม่ยินยอมให้เราใช้คุกกี้ประเภทนี้ ท่านอาจได้รับข้อมูลและโฆษณาทั่วไปที่ไม่ตรงกับความสนใจของท่าน',
      },
      {
        checked: false,
        title: 'คุกกี้โดยบุคคลที่สาม',
        description: 'เว็บไซต์ของเรามีการใช้คุกกี้โดยบุคคลที่สาม ซึ่งลักษณะการใช้งานและการตั้งค่าจะเป็นไปตามคุกกี้ 4 ประเภทแรก โดยท่านจะไม่สามารถเลือกตั้งค่าการใช้งานเฉพาะคุกกี้โดยบุคคลที่สามได้ ทั้งนี้ เราไม่สามารถควบคุมการใช้ข้อมูลของบุคคลที่สามนั้นได้ ท่านสามารถตรวจสอบรายชื่อของบุคคลที่สาม นโยบายความเป็นส่วนตัว (Privacy Notice) และนโยบายการใช้คุกกี้ของบุคคลที่สาม ซึ่งแตกต่างจากเว็บไซต์ของเราได้ที่เว็บไซต์ของบุคคลที่สามนั้น ๆ',
      }
    ]
  }),

  watch: {
    items: {
      handler: function(val) {
        let acceptAll = true
        val.forEach((element) => {
          if (!element.checked) acceptAll = false
        })
        this.acceptAll = acceptAll
      },
      deep: true
    }
  },

  computed: {
    ...mapState(['showSetting', 'cssVars']),
  },

  mounted() {
    window.addEventListener('keydown', ev => {
      if (ev.keyCode === 27) {
        this.$store.commit('SHOW_SETTING', false)
      }
    })
  },

  methods: {
    onToggle(index) {
      this.$set(this.isOpen, index, !this.isOpen[index])
    },

    onAcceptAll() {
      this.items.forEach((element, index) => {
        if (!element.checked) this.items[index].checked = true
      })
    }
  }
}
</script>

<style lang="scss" scopd>
.thailand-pdpa {
  &-setting {
    position: fixed;
    z-index: 99999;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;

    &-container {
      position: relative;
      width: 700px;
      height: calc(100% - 3.5rem);
      padding: 1.25rem 2rem;
      margin: 1.75rem auto;
      transition: 0.3s ease;
      pointer-events: none;
      z-index: 2;

      @media screen and (max-width: 767px) {
        width: 100vw;
        padding: 0 1rem;
      }

      [data-type="sidebar"] & {
        width: 440px;
        height: 100%;
        margin: 0;
        padding: 0;

        @media screen and (max-width: 500px) {
          width: 100vw;
        }

      }

      [data-type="sidebar"][data-position="right"] & {
        float: right;
      }
    }
  
    &-content {
      position: relative;
      max-height: 100%;
      display: flex;
      flex-direction: column;
      width: 100%;
      pointer-events: auto;
      background-color: #fff;
      border: 1px solid rgba(0,0,0,.2);
      outline: 0;
      overflow: hidden;
      transition: transform 0.3s ease;

      .modal-enter &,
      .modal-leave-active & {
        transform: scale(1.05);
      }

      [data-position="left"].sidebar-enter &,
      [data-position="left"].sidebar-leave-active & {
        transform: translateX(-100%);
      }

      [data-position="right"].sidebar-enter &,
      [data-position="right"].sidebar-leave-active & {
        transform: translateX(100%);
      }


      [data-type="modal"] & {
        border-radius: 0.5rem;
      }

      [data-type="sidebar"] & {
        height: 100%;
      }

      @media (min-width: 992px){
        ::-webkit-scrollbar-track{
          background-color: #fff;
        }
        ::-webkit-scrollbar{
          height: 0.5rem;
          width: 0.5rem;
          background-color: #fff;
        }
        ::-webkit-scrollbar-thumb{
          background-color: #c1c1c1;

          [data-type="modal"] & {
            border-radius: 0.5rem;
          }
        }
      }
    }
  
    &-header {
      display: flex;
      flex-shrink: 0;
      align-items: center;
      justify-content: space-between;
      padding: 0.75rem 2rem;
      border-bottom: 1px solid #dee2e6;

      [data-type="sidebar"] & {
        padding-left: 1rem;
        padding-right: 1rem;
      }

      h5 {
        font-weight: bold;
        font-size: 1.25rem;
      }

      button {
        display: block;
        padding: 0.5rem !important;
        margin: 0 -0.5rem 0 0 !important;
        border: none !important;
        background: transparent !important;
        opacity: 0.5;

        [data-type="modal"] & {
          margin-right: -1rem !important;
        }

        &:hover {
          opacity: 1;
        }

        svg {
          width: 1.5rem;
          height: 1.5rem;
          display: block;

          [data-type="sidebar"] & {
            width: 1.25rem;
            height: 1.25rem;
          }
        }
      }
    }
  
    &-body {
      position: relative;
      flex: 1 1 auto;
      padding: 2rem;
      overflow-y: auto;

      [data-type="sidebar"] & {
        padding: 1rem;
      }

      h3 {
        font-weight: bold;
        font-size: 1.25rem;
        margin: 0 0 1rem;
      }

      p {
        margin-bottom: 1rem;
      }
    }

    &-manage {
      padding-top: 2rem;

      &-list {
        list-style: none;
        padding: 0;
        margin: 0 0 1rem;
      }

      &-item {
        border: solid 1px #dee2e6;
        border-radius: 4px;
        padding: 0.875rem 1rem;
        margin: 0;

        &:not(:last-child) {
          margin-bottom: 0.5rem;
        }

        &.is-open {
          background: #fcfcfc;
        }
      }

      &-header {
        font-weight: bold;
        cursor: pointer;
        user-select: none;
        display: flex;
        align-items: center;
        justify-content: space-between;

        .is-open & {
          color: var(--tpdpa-primary);
        }

        input[type=checkbox] {
          width: 2.5rem !important;
          height: 1.375rem !important;
          display: block;
          background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='rgba%280, 0, 0, 0.25%29'/%3e%3c/svg%3e");
          background-position: left center;
          background-size: contain;
          background-color: #fff;
          background-repeat: no-repeat;
          border: solid 1px #bfbfbf !important;
          border-radius: 2rem !important;
          transition: background-position 0.15s ease-in-out;
          appearance: none;

          &::after {
            display: none;
          }

          &:checked {
            border-color: var(--tpdpa-primary) !important;
            background-color: var(--tpdpa-primary);
            background-position: right center;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e")
          }
        }
      }

      &-title {
        width: 100%;
        line-height: 1;
        font-size: 1rem;
        display: flex;
        align-items: center;
        // justify-content: space-between;

        span {
          height: 1.25rem;
          margin: 0 0.5rem 0 -0.25rem;
        }

        svg {
          width: 1.25rem;
          height: 1.25rem;
        }
      }

      &-description {
        padding-top: 1rem;
        padding-left: 1.75rem;
      }
    }

    &-footer {
      display: flex;
      flex-wrap: wrap;
      flex-shrink: 0;
      align-items: center;
      padding: 0.75rem 2rem;
      border-top: 1px solid #dee2e6;

      [data-type="modal"] & {
        justify-content: flex-end;
      }

      [data-type="sidebar"] & {
        padding-left: 1rem;
        padding-right: 1rem;
      }
    }
  
    &-backdrop {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 1050;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.3);
      z-index: 1;
    }
  }

  &-form {
    [data-type="modal"] & {
      display: flex;
    }

    &-item {
      [data-type="sidebar"] & {
        margin-bottom: 1rem;
      }
    }
  }

  &-customize {
    padding: 0 2rem 2rem;
    margin: 0 -2rem 2rem;
    border-bottom: 1px solid #dee2e6;

    [data-type="sidebar"] & {
      padding: 0 1rem 1rem;
      margin: 0 -1rem 2rem;
    }

    label {
      margin-right: 20px;
    }
  }
}
.sidebar-enter-active,
.sidebar-leave-active,
.modal-enter-active,
.modal-leave-active {
  transition: opacity 0.2s;
}

.sidebar-enter,
.sidebar-leave-to,
.modal-enter,
.modal-leave-to {
  opacity: 0;
}
</style>