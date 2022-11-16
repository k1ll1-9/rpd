<template>
  <Teleport to="body">
  <div class="modal fade" :id="id" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center w-100"><slot name="title"></slot></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <p class="text-center"  ><slot name="body"></slot></p>
        </div>
        <div class="modal-footer d-flex justify-content-center">
          <template v-if="!passive">
          <button type="button" class="btn btn-danger" @click="$emit('confirm')" data-bs-dismiss="modal">Да</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Нет</button>
          </template>
          <button v-else type="button" class="btn btn-secondary" data-bs-dismiss="modal">ОК</button>
        </div>
      </div>
    </div>
  </div>
  </Teleport>
</template>

<script>
export default {
  name: "ModalWarning",
  props: ['id','passive'],
  emits: ["confirm"]
}
</script>

<style scoped>
.modal.fade .modal-dialog {
  -webkit-transform: translate(0);
  -moz-transform: translate(0);
  transform: translate(0);
}
.modal-footer button{
  width: 75px;
  margin: 5px 20px;
}
</style>
