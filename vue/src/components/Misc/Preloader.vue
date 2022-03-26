<template>
  <div class="wrapper d-flex flex-column justify-content-center  align-items-center">
  <div class="preloader"></div>
  </div>
</template>

<script>
export default {
  name: "Preloader"
}
</script>

<style scoped>

.preloader {
  animation: rotateY-anim 2s linear infinite;
  background: url('../../assets/img/logo.png');
  width: 128px;
  height: 128px;
}

@keyframes rotateY-anim {
  0% {
    transform: rotateY(0deg);
  }

  100% {
    transform: rotateY(360deg);
  }
}
</style>
