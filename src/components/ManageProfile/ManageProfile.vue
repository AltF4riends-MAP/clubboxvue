<template>
    <div class="main-container">
      <header-comp :cart-item-count="cart.length"></header-comp>
      <background-scene>
        <div class="right-box">
          <h1>Manage User</h1>
          <form @submit.prevent="updateUser">
            <div class="top-form">
              <label for="firstName">First Name:</label>
              <input type="text" id="firstName" v-model="user.firstName" required>
  
              <label for="lastName">Last Name:</label>
              <input type="text" id="lastName" v-model="user.lastName" required>
            </div>
  
            <div class="top-form">
              <label for="matricNo">Matric No:</label>
              <input type="text" id="matricNo" v-model="user.matricNo" required>
  
              <label for="yearCourse">Year/Course:</label>
              <input type="text" id="yearCourse" v-model="user.yearCourse" required>
            </div>
  
            <div class="top-form">
              <label for="phoneNumber">Phone Number:</label>
              <input type="text" id="phoneNumber" v-model="user.phoneNumber" required>
  
              <label for="address">Address:</label>
              <input type="text" id="address" v-model="user.address" required>
            </div>
  
            <label for="password">Password:</label>
              <input type="password" id="password" v-model="user.password" required>
  
            <button type="submit">Update</button>
          </form>
        </div>
      </background-scene>
      <footer-comp></footer-comp>
    </div>
  </template>
  
  <script>
  import BackgroundScenery from '../general/BackgroundScenery.vue';
  import FooterComponent from '../general/FooterComponent.vue';
  import HeaderComponent from '../general/HeaderComponent.vue';
  import axios from 'axios';
  import { mapState } from 'vuex';
  
  export default {
    name: 'ManageProfile',
    props: {
      cart: {
        type: Array,
        required: true
      }
    },
    components: {
      'footer-comp': FooterComponent,
      'background-scene': BackgroundScenery,
      'header-comp': HeaderComponent
    },
    data() {
      return {
        user: {
          firstName: '',
          lastName: '',
          matricNo: '',
          yearCourse: '',
          phoneNumber: '',
          address: '',
          password: ''
        }
      };
    },
    computed: {
      ...mapState(['userId'])
    },
    created() {
      this.fetchUserData();
    },
    methods: {
      async fetchUserData() {
        try {
          const response = await axios.get(`http://localhost/ClubBoxPHP/student/${this.userId}`);
          this.user = response.data;
        } catch (error) {
          console.error('Error fetching user data:', error);
        }
      },
      async updateUser() {
        try {
          const response = await axios.put(`http://localhost/ClubBoxPHP/student/${this.userId}`, this.user);
          console.log('User updated:', response.data);
        } catch (error) {
          console.error('Error updating user:', error);
        }
      }
    }
  };
  </script>
  
  <style scoped>
  .main-container {
    position: relative;
    min-height: 100vh;
  }
  
  .right-box {
    width: 85%;
    padding: 1em;
    border-radius: 5px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    background-color: white;
    display: flex;
    flex-direction: column;
    align-items: center;
  }
  
  form {
    width: 75%;
    display: flex;
    flex-direction: column;
    justify-content: left;
    margin-top: 7vh;
  }
  
  .top-form {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    margin-bottom: 2vh;
  }
  </style>
  