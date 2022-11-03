export default {
  data() {
    return {
      isValid: true
    }
  },
  methods: {
    validate() {
      let valid = true

      this.requiredFields.forEach((ref) => {

        if (ref.$el?.ej2_instances !== undefined && ref.$el?.ej2_instances[0]?.localeObj?.controlName === 'richtexteditor') {
          ref.$el.value = ref.$el?.ej2_instances[0].vueInstance.getText()
        }

        if (ref.$el.value === undefined || ref.$el.value.trim() === '') {
          if (ref.$el.classList.contains('e-rte-hidden')) {
            ref.$el.parentElement.classList.add('invalid')
          }
          ref.$el.classList.add('invalid')
          valid = false
        } else {
          if (ref.$el.classList.contains('e-rte-hidden')) {
            ref.$el.parentElement.classList.remove('invalid')
          }
          ref.$el.classList.remove('invalid')
        }
      })

      if (this.isValid !== valid) {

        this.isValid = valid

        if (this.isValid) {
          this.$store.commit('rpd/REMOVE_ERROR', this.noticeData);
        } else {
          this.$store.commit('rpd/ADD_ERROR', this.noticeData);
        }
      }

    }
  }
}
