<template>
  <div class="wrapper">
    <div class="my-4">
      <p class="text-start my-1">Разработчик программы:</p>
      <TextInput class="my-2 author-input" placeholder='ФИО'
                 :identity="['managed','authors','author','FIO']"/>
      <TextInput class="my-2 author-input" placeholder='Должность'
                 :identity="['managed','authors','author','position']"/>
    </div>
    <div class="my-4">
      <p class="text-start my-1">Рецензент:</p>
      <TextInput class="my-2 author-input" placeholder='ФИО'
                 :identity="['managed','authors','reviewer','FIO']"/>
      <TextInput class="my-2 author-input" placeholder='Должность'
                 :identity="['managed','authors','reviewer','position']"/>
    </div>
  </div>
</template>

<script>

import TextInput from "../UI/TextInput";

export default {
  name: "Authors",
  components: {TextInput}

}
</script>

<style scoped>
p {
  margin: 0;
}

.wrapper {
  margin: 40px 0;
}

.author-input {
  width: 40%;
}
</style>
