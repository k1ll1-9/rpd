<template>
  <tr>
    <td v-for="key in 4" :key="key">
      <span v-if="key === 1">{{ row }}</span>
      <div v-else class="input-group">
        <input @input="log" v-model="msg" type="text" class="form-control">
      </div>
    </td>
  </tr>
</template>

<script>
export default {
  name: 'TableRow',
  props: {
    row: Number
  },
  data() {
    return {
      msg: ''
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
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
</style>
