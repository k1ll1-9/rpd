export default {
  data() {
    return {
      isValid: true
    }
  },
  methods: {
    validate(extraValidation = null) {
      let valid = true

      this.requiredFields.forEach((ref) => {

        if (ref.$el?.ej2_instances !== undefined && ref.$el?.ej2_instances[0]?.localeObj?.controlName === 'richtexteditor') {
          ref.$el.value = ref.$el?.ej2_instances[0].vueInstance.getText()
        }

        if (ref.$el?.ej2_instances !== undefined && ref.$el?.ej2_instances[0]?.listData !== undefined) {
          ref.$el.value = ref.$el?.ej2_instances[0].value?.length === 0 ? '' : ref.$el.ej2_instances[0].value
        }

        if (ref.$el.value === undefined || ref.$el.value.trim() === '') {
          if (ref.$el.classList.contains('e-rte-hidden')) {
            ref.$el.parentElement.classList.add('invalid')
          } else if (ref.$el.classList.contains('e-multiselect')) {
            ref.$el.closest('.e-multi-select-wrapper').classList.add('invalid')
          } else {
            ref.$el.classList.add('invalid')
          }
          valid = false
        } else {
          if (ref.$el.classList.contains('e-rte-hidden')) {
            ref.$el.parentElement.classList.remove('invalid')
          } else if (ref.$el.classList.contains('e-multiselect')) {
            ref.$el.closest('.e-multi-select-wrapper').classList.remove('invalid')
          } else {
            ref.$el.classList.remove('invalid')
          }
        }
      })

      if (extraValidation !== null){
        valid = valid && extraValidation
      }

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
