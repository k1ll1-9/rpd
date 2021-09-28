<template>
  <h3 class="my-4"><strong>СОДЕРЖАНИЕ ДИСЦИПЛИНЫ</strong></h3>
  <table class="table" @input="updateData">
    <thead style="border-bottom: 1px #000000 solid">
    <tr>
      <th class="col-1">№ п/п</th>
      <th class="col-4">Наименование раздела дисциплины</th>
      <th class="col-5">Вид самостоятельной работы</th>
      <th class="col-2">Трудоемкость <br> (в акад. часах)</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(items,index) in rows" :key="index">
      <td>
        <span>{{ index + 1 }}</span>
      </td>
      <td>
        <div class="input-group">
          <input type="text" class="form-control" @change="updateData" v-model="items.name">
        </div>
      </td>
      <td>
        <div class="input-group">
          <input type="text" class="form-control" @change="updateData" v-model="items.type">
        </div>
      </td>
      <td>
        <div class="input-group">
          <input type="text" class="form-control" @change="updateData" @input="checkHours" v-model="items.hours">
        </div>
      </td>
    </tr>
    </tbody>
  </table>
  <div class="alert alert-danger" role="alert" v-if="sumHours>50">
    Суммарная трудоемкость не должна быть больше {{ contents.totalTime }}
  </div>
</template>

<script>
export default {
  name: 'DiscContent',
  props: {
    contents: [String, Object]
  },
  data() {
    return {
      rows: this.contents.units,
    }
  },
  mounted() {
    console.log(this.contents.units)
  },
  computed: {
    sumHours: function () {
      let sum = 0;
    
      if (this.rows !== undefined) {
        this.rows.forEach((item) => {
          if (item.hours !== '') {
            sum += parseInt(item.hours);
          }
        })
      }
      return sum;
    }
  },
  methods: {
    log() {
      this.axios.post('https://lk.vavt.ru/axios.php',
          {test: this.msg},
          {headers: {'Content-Type': 'multipart/form-data'}})
          .then((response) => {
            console.log(response.data)
          })
    }
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

td {
  vertical-align: middle;
}
</style>
