<template>
    <div class="club-card">
      <img v-if="image" :src="image" alt="Club Image" class="club-image"/>
      <div class="club-details">
        <h2 class="club-title">{{ title }}</h2>
        <p class="club-description">{{ description }}</p>
        <button @click="process">Join Club</button>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ClubCard',
    props: {
      title: {
        type: String,
        required: true
      },
      date: {
        type: String,
        required: true
      },
      description: {
        type: String,
        required: true
      },
      price: {
        type: Number,
        required: true
      },
      image: {
        type: String,
        required: false
      }
    },
    
  };
  </script>
  
  <style scoped>
  .club-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    overflow: hidden;
    transition: box-shadow 0.3s;
    background-color: white;
    width: 20%;
    height: 60vh;
  }
  
  .club-card:hover {
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
  
  .club-image {
    width: 15vw;
    height: 30vh;
    border-bottom: 1px solid #ddd;
  }
  
  .club-details {
    padding: 15px;
    text-align: center;
  }
  
  .club-title {
    font-size: 1.3em;
    margin: 10px 0;
  }
  
  .club-date {
    color: gray;
    margin-bottom: 10px;
  }
  
  .club-description {
    font-size: 1em;
    color: #333;
  }
  
  .club-price {
    font-size: 1em;
    color: #333;
  }
  
  button {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: maroon;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  button:hover {
    background-color: darkgreen;
  }
  </style>
  