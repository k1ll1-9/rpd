<template>
  <ejs-richtexteditor ref="rteObj"
                      :value="value"
                      @change="updateState"
                      @beforePasteCleanup="cleanup"
                      :pasteCleanupSettings="pasteCleanupSettings"
                      :toolbarSettings="toolbarSettings"/>
</template>

<script>

import {
  RichTextEditorComponent,
  Toolbar,
  Link,
  Image,
  HtmlEditor,
  PasteCleanup,
} from "@syncfusion/ej2-vue-richtexteditor"

export default {
  components: {
    "ejs-richtexteditor": RichTextEditorComponent,
  },
  name: "VisualEditor",
  props: ['identity'],
  data() {
    return {
      fontSize: {
        default: "16pt"
      },
      toolbarSettings: {
        items: ['Bold', 'Italic', 'Underline', 'StrikeThrough', 'FontSize',
          'LowerCase', 'UpperCase', '|',
          'Formats', 'Alignments', 'OrderedList', 'UnorderedList',
          'Outdent', 'Indent', '|',
          'SourceCode', '|', 'Undo', 'Redo'
        ]
      },
      pasteCleanupSettings: {
        prompt: false,
        deniedAttrs: ["style"],
        allowedStyleProps: [],
        deniedTags: ["br"],
        keepFormat: true,
        plainText: false
      }
    }
  },
  methods: {
    cleanup() {
      console.log('paste')
    }
    ,
    updateState() {
      console.log('upd');
      /*      var instance = this.$refs.rteObj.$el.ej2_instances[0];
            console.log(instance)
            instance.updateValue(this.$refs.rteObj.ej2Instances.getHtml() + 'YOBA');*/
      this.$store.dispatch('rpd/updateData', {
        identity: this.identity,
        value: this.$refs.rteObj.ej2Instances.getHtml(),
        updateType: 'UPDATE_RPD_ITEM'
      });
    }
  }
  ,
  computed: {
    value() {

      return this.identity.reduce((acc, c) => acc && acc[c], this.$store.state.rpd)
    }
  }
  ,
  provide: {
    richtexteditor: [Toolbar, Link, Image, HtmlEditor, PasteCleanup],
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
  text-align: left;
  font-size: 12pt;
}
</style>
