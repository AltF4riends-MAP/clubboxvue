<template>
    <div class="main-container">
      <header-comp></header-comp>
      <background-scene>
        <div class="container">
          <div class="maroon-box">
            <img class="unity" src="../../assets/unity.png" alt="Unity Image">
            <h1 class="title-faq">Frequently Asked Questions</h1>
          </div>
          <div class="white-box">
            <div class="question-box">
              Hi
            </div>
          </div>
        </div>
      </background-scene>
      <footer-comp></footer-comp>
    </div>
  </template>
  
  <script>
  import BackgroundScenery from '../general/BackgroundScenery.vue';
  import FooterComponent from '../general/FooterComponent.vue';
  import HeaderComponent from '../general/HeaderComponent.vue'
  
  export default {
    name: 'FaqPage',
    components: {
      'footer-comp': FooterComponent,
      'background-scene': BackgroundScenery,
      'header-comp': HeaderComponent,
    },
  }
  </script>
  
  <style scoped>
  html, body {
    margin: 0;
    padding: 0;
    height: 100%;
    overflow: hidden; 
  }
  
  .main-container {
    position: relative;
    min-height: 150vh; 
    display: flex;
    flex-direction: column;
  }
  
  header-comp {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000; 
  }
  
  footer-comp {
    position: relative; 
    width: 100%;
    margin-top: auto; 
  }
  
  .container {
    width: 100%;
    padding: 0;
    margin-top: 70px; 
    margin-bottom: 20px; 
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
    background-attachment: local;
    overflow: hidden;
  }
  
  .maroon-box {
    width: 100%;
    padding: 0;
    border-radius: 5px;
    background-color: rgba(128, 0, 0, 0.7);
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
  }
  
  .white-box {
    width: 100%;
    padding: 1em;
    border-radius: 5px;
    background-color: white;
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: center;
    min-height: 100vh;
    flex: 1; 
  }
  
  .question-box {
    width: 40%;
    height: auto; 
    border-radius: 10px;
    padding: 1em;
    background-color: maroon;
    color: white; 
  }
  
  .unity {
    width: 50%;
    height: auto; 
    margin: 0 auto; 
  }
  
  .title-faq {
    font-size: 3.1em; 
    color: white;
    text-align: center; 
  }
  </style>
  