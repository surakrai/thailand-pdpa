<template lang="pug">
  .thailand-pdpa-wrapper(:style="cssVars")
    alert
    setting

</template>

<script>
import { mapState } from 'vuex'
import Setting from './components/Setting'
import Alert from './components/alert'

export default {
  components: { Setting, Alert },
  data: () => ({
    type: TPDPA.popup,
  }),

  computed: {
    ...mapState(['showSetting', 'cssVars']),
  },
  // watch: {
  //   showSetting() {
  //     document.documentElement.classList.toggle('show-setting')
  //   }
  // }
}
</script>
