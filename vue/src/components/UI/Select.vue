<template>
  <DropDown  ref="input"
             @change="updateState"/>
</template>

<script>
import { DropDownListComponent } from "@syncfusion/ej2-vue-dropdowns";

export default {
  name: "Select",
  props: ['identity'],
  components : {
    "DropDown" : DropDownListComponent
  },
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
        value: e.value,
        updateType: 'UPDATE_RPD_ITEM'
      });
    },
  },
  computed: {},
  mounted() {
    this.$refs.input.$el.value = this.identity.reduce((acc, c) => acc && acc[c], this.$store.state.rpd)
  }
}
</script>

<style scoped>
@import "../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-dropdowns/styles/material.css";
.invalid,.invalid.form-control:focus  {
  border: none !important;
  box-shadow:  none !important;
}
</style>

