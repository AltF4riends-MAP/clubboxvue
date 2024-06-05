<template>
    <div class="card">
      <div class="card-header">
        <h2>{{ title }}</h2>
        <div class="dropdown">
          <button @click="toggleDropdown" class="dropbtn"> || </button>
          <div v-if="dropdownOpen" class="dropdown-content">
            <p>{{ answer }}</p>
          </div>
        </div>
      </div>
      <div class="card-content">
        <slot></slot>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    name: 'FaqCard',
    props: ["title", "answer"],
    data() {
      return {
        dropdownOpen: false
      };
    },
    methods: {
      toggleDropdown() {
        this.dropdownOpen = !this.dropdownOpen;
      }
    }
  };
  </script>
  
  <style scoped>
  .card {
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin: 10px;
    padding: 20px;
    position: relative;
  }
  
  .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }
  
  .dropdown {
    position: relative;
    display: inline-block;
  }
  
  .dropbtn {
    background-color: maroon;
    color: white;
    padding: 5px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
  }
  
  .dropdown-content {
    display: block;
    position: absolute;
    background-color: white;
    min-width: 160px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    z-index: 1;
    border-radius: 5px;
    padding: 10px;
    left: -170px;
  }
  
  .dropdown-content p {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    border-bottom: 1px solid #ddd;
    
  }
  
  .dropdown-content p:hover {
    background-color: #f1f1f1;
  }
  </style>
  