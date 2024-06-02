<template>
    <div class="footer">
      <div class="left-box">
        <twitter-icon class="icon"></twitter-icon>
        <telegram-icon class="icon"></telegram-icon>
        <img src="../../assets/clubbox.jpeg" class="logo">
      </div>
      <div class="right-box">
        <h3 class="footer-text">@2024 AltF4riends All rights reserved</h3>
      </div>
    </div>
  </template>
  
  <script>
  import { AiInaturalist, CoTelegram } from "oh-vue-icons/icons";
  import { addIcons } from "oh-vue-icons";
  
  addIcons(AiInaturalist, CoTelegram);
  
  export default {
    name: 'FooterComponent',
    components: {
      'twitter-icon': AiInaturalist,
      'telegram-icon': CoTelegram,
    }
  }
  </script>
  
  <style scoped>
  .footer {
    background-color: black;
    color: white;
    width: 101.3%;
    position: absolute;
    bottom: 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 20px;
    box-sizing: border-box;
 
  }
  
  .left-box, .right-box {
    display: flex;
    align-items: center;
  }
  
  .left-box {
    flex: 1;
  }
  
  .right-box {
    flex: 1;
    justify-content: flex-end;
  }
  
  .icon {
    margin-right: 10px;
    font-size: 1.5em;
  }
  
  .logo {
    width: 10%;
    height: auto;
  }
  
  .footer-text {
    font-size: 1em;
    margin: 0;
  }
  </style>
  