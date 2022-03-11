<template>
  <ejs-richtexteditor @change="test">

  </ejs-richtexteditor>
</template>

<script>

import {RichTextEditorComponent, Toolbar, Link, Image, HtmlEditor, Table} from "@syncfusion/ej2-vue-richtexteditor"

export default {
  components: {
    "ejs-richtexteditor": RichTextEditorComponent,
  },
  name: "VisualEditor",
  data() {
    return {}
  },
  methods: {
    test(e){
      console.log(e.value.replace(/<[^>]*>?/gm, ''))
    }
  },
  provide: {
    richtexteditor: [Toolbar, Link, Image, HtmlEditor, Table],
  }
}
</script>

<style scoped>
@import "../../../node_modules/@syncfusion/ej2-base/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-inputs/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-lists/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-popups/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-buttons/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-navigations/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-splitbuttons/styles/material.css";
@import "../../../node_modules/@syncfusion/ej2-vue-richtexteditor/styles/material.css"
</style>
