<template>
  <input class="form-control"
         type="text"
         :value="value"
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
      lastValid : null
    }
  },
  methods: {
    updateState(e) {
      this.$store.dispatch('updateData', {identity: this.identity, value: e.target.value , updateType: 'UPDATE_RPD_ITEM'});
    },
    validate(e) {
      const pattern = /^(0|[1-9]\d*)$/g;
      if (!pattern.test(e.target.value)) {
        e.target.value = this.lastValid;
      } else {
        this.lastValid = e.target.value
      }
    }
  },
  computed: {
    value() {
      return this.identity.reduce((acc, c) => acc && acc[c], this.$store.state)
    }
  }

}
</script>

<style scoped>

</style>
