<template>
  <input class="form-control"
         type="text"
         :value="value"
         @blur="updateState">
</template>

<script>

export default {
  name: "TextInput",
  props: ['identity'],
  methods: {
    updateState(e) {
      const newValue = e.target.value.trim()
      if (newValue !== '') {
        this.$store.dispatch('updateData', {identity: this.identity, value: e.target.value});
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
