<template>
  <div>
    <h3 class="my-4"><strong>СОДЕРЖАНИЕ ДИСЦИПЛИНЫ</strong></h3>
    <table class="table">
      <thead style="border-bottom: 1px #000000 solid">
      <tr>
        <th class="col-1">№ п/п</th>
        <th class="col-4">Наименование раздела дисциплины</th>
        <th class="col-5">Вид самостоятельной работы</th>
        <th class="col-2">Трудоемкость <br> (в акад. часах)</th>
      </tr>
      </thead>
      <tbody>
      <TableRow v-for="(item,index) in contents"
                :key="index"
                :item="item"
                :index="index"
                @deleteRow="$emit('deleteRow',{ index: $event, unit: 'discStructure'})"
                @updateField="updateField"
      />
      </tbody>
    </table>
    <button type="button" @click="addRow" class="btn btn-primary">Добавить строку</button>
    <br>
    <button type="button" @click="$store.commit('increment')" class="btn btn-primary">TestFlux</button>
  </div>
</template>

<script>

import TableRow from "./UI/TableRow";

export default {
  components: {
    TableRow
  },
  name: 'DiscStructure',
  props: {
    discStructure: Array
  },
  computed: {
    contents: function () {
      return [...this.discStructure]
    }
  },
  methods: {
    updateField(e) {
      this.$emit('updateField', {
        discStructure: e
      });
    },
    addRow() {
      const newRow = Object.fromEntries(Object.entries(this.discStructure[0]).map(([key, val]) => {
        val = null;
        return [key, val]
      }));

      this.$emit('addRow', {
        unit: 'discStructure',
        row: newRow
      });
    }
  },
  mounted() {

  }
}
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}

th {
  vertical-align: middle;
}

</style>
