<template>
  <ejs-richtexteditor ref="rteObj" :value="value" @change="updateState"/>
</template>

<script>

import {RichTextEditorComponent, Toolbar, Link, Image, HtmlEditor} from "@syncfusion/ej2-vue-richtexteditor"

export default {
  components: {
    "ejs-richtexteditor": RichTextEditorComponent,
  },
  name: "VisualEditor",
  props: ['identity'],
  data() {
    return {}
  },
  methods: {
    updateState() {
      this.$store.dispatch('updateData', {
        identity: this.identity,
        value: this.$refs.rteObj.ej2Instances.getHtml(),
        updateType: 'UPDATE_RPD_ITEM'
      });
    }
  },
  computed: {
    value() {
      return this.identity.reduce((acc, c) => acc && acc[c], this.$store.state)
    }
  },
  provide: {
    richtexteditor: [Toolbar, Link, Image, HtmlEditor],
  }
}
</script>

<style>
@import "../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-lists/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-popups/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-buttons/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-navigations/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-splitbuttons/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-richtexteditor/styles/material.css";

.e-richtexteditor .e-rte-content .e-content {
  min-height: 400px;
}
</style>
