<template>
  <div class="background">
    <div class="cover">
      <slot></slot> 
    </div>
  </div>
</template>

<script>
export default {
  name: 'BackgroundScenery',
}
</script>

<style scoped>
.background {
  width: 100vw;
  height: 100vh;
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.762);
  background-image: url("../../assets/utm.jpg");
  background-repeat: no-repeat;
  background-size: cover;
  background-attachment: fixed;
  position: relative;
}

.cover {
  width: 100vw;
  height: 100vh;
  margin: 0;
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: center;
 
  background-color: rgba(0, 0, 0, 0.5);
  background-attachment: fixed;
  position: relative;
  top: 0;
  left: 0;
}
</style>
