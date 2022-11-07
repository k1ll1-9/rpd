<template>
  <textarea class="form-control"
            type="text"
            ref="input"
            @change="updateState"></textarea>
</template>
<script>

export default {
  name: "TextArea",
  props: ['identity'],
  data() {
    return {}
  },
  methods: {
    updateState(e) {
      if (e.event === null) {
        return false
      }
      this.$store.dispatch('rpd/updateData',
          {
            identity: this.identity,
            value: e.target.value,
            updateType: 'UPDATE_RPD_ITEM'
          });
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
