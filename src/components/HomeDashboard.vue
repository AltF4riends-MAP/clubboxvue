<template>
  <div class="main-container">
    <header-comp></header-comp>
    <background-scene>

    </background-scene>

    <footer-comp></footer-comp>
  </div>
</template>

<script>
import BackgroundScenery from './general/BackgroundScenery.vue';
import FooterComponent from './general/FooterComponent.vue';
import HeaderComponent from './general/HeaderComponent.vue'

export default {
  name: 'HomeDashboard',
  components:{
    'footer-comp': FooterComponent,
    'background-scene': BackgroundScenery,
    'header-comp' : HeaderComponent,
  },
}
</script>

<style scoped>

.main-container {
  position: relative;
  min-height: 113vh;
}

.scrollable-box {
  width: 100%;
  overflow-y: hidden; 
  display: flex;
  margin-top: 10vh;
  height: calc(100vh - 50px); 
}


</style>
