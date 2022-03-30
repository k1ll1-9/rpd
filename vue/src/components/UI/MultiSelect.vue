<template>
  <MultiSelect :value="value" @change="updateState" />
</template>

<script>

import {MultiSelectComponent} from "@syncfusion/ej2-vue-dropdowns";

export default {
  name: "Select",
  props: ['identity'],
  components: {
    "MultiSelect": MultiSelectComponent
  },
  data() {
    return {
      fields: {text: 'text', value: 'value'}
    }
  },
  methods: {
    updateState(e) {
            this.$store.dispatch('rpd/updateData', {
              identity: this.identity,
              value: e.value,
              updateType: 'UPDATE_RPD_ITEM'
            });
    },
  },
  computed: {
        value() {
          return this.identity.reduce((acc, c) => acc && acc[c], this.$store.state.rpd)
        }
  }

}
</script>

<style>
@import "../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-dropdowns/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-buttons/styles/material.css";

.defaults.e-ddl.e-input-group.e-control-wrapper .e-input {
  text-align: center;
}

.defaults .e-list-item {
  color: #000000;
}

.defaults .e-dropdownbase .e-list-item:active {
  color: #0b66c3;
}

.defaults.e-input-group:not(.e-float-icon-left):not(.e-float-input)::before,
.defaults.e-input-group:not(.e-float-icon-left):not(.e-float-input)::after {
  height: 2px;
  background: #0b66c3;
}

.defaults .e-dropdownbase .e-list-item.e-active,
.defaults .e-dropdownbase .e-list-item.e-active.e-hover {
  color: #0b66c3;
}

.e-input-group:not(.e-float-icon-left):not(.e-float-input)::before, .e-input-group:not(.e-float-icon-left):not(.e-float-input)::after, .e-input-group.e-float-icon-left:not(.e-float-input) .e-input-in-wrap::before, .e-input-group.e-float-icon-left:not(.e-float-input) .e-input-in-wrap::after, .e-input-group.e-control-wrapper:not(.e-float-icon-left):not(.e-float-input)::before, .e-input-group.e-control-wrapper:not(.e-float-icon-left):not(.e-float-input)::after, .e-input-group.e-control-wrapper.e-float-icon-left:not(.e-float-input) .e-input-in-wrap::before, .e-input-group.e-control-wrapper.e-float-icon-left:not(.e-float-input) .e-input-in-wrap::after {
  color: blueviolet !important;
}

</style>
