<template>
  <textarea class="form-control "
            type="text"
            :value="value"
            @focus="lastValid = $event.target.value"
            @change="updateState"></textarea>
</template>
<script>

export default {
  name: "TextArea",
  props: ['identity'],
  data() {
    return {
      lastValid: null
    }
  },
  methods: {
    updateState(e) {
      this.$store.dispatch('updateData', {
        identity: this.identity,
        value: e.target.value,
        updateType: 'UPDATE_RPD_ITEM'
      });
    },
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
