<template>
  <input class="form-control"
         type="text"
         ref="input"
         @focus="lastValid = $event.target.value"
         @input="validate"
         @change="updateState">
</template>

<script>

export default {
  name: "DigitInput",
  props: ['identity'],
  data() {
    return {
      lastValid: null
    }
  },
  methods: {
    updateState(e) {
      if (e.event === null) {
        return false
      }
      this.$store.dispatch('rpd/updateData', {
        identity: this.identity,
        value: parseInt(e.target.value.trim()) || null,
        updateType: 'UPDATE_RPD_ITEM'
      });
    },
    validate(e) {
      const pattern = /^(|\d)+$/g;
      if (!pattern.test(e.target.value)) {
        e.target.value = this.lastValid;
      } else {
        this.lastValid = e.target.value
      }
    }
  },
  computed: {},
  mounted() {
    this.$refs.input.value = this.identity.reduce((acc, c) => acc && acc[c], this.$store.state.rpd) || ''
  }

}
</script>

<style scoped>

</style>
