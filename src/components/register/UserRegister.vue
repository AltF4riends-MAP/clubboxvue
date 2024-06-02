<template>
  <div class="main-container">
    <background-scene>
      <div class="container">
        <div class="scrollable-box">
          <div class="left-box"></div>
          <div class="right-box">
            <h1>Register User</h1>
            
            <form @submit.prevent="registerUser">
              <div class="top-form">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" v-model="user.firstName" required>
                
                <label for="lastName">Last Name:</label>
                <input type="text" id="lastName" v-model="user.lastName" required>
              </div>

              <div class="top-form">
                <label for="matricNo">Matric No  :</label>
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
              <label for="email">Email:</label>
              <input type="email" id="email" v-model="user.email" required>

              <label for="password">Password:</label>
              <input type="text" id="password" v-model="user.password" required>

              <label for="cPassword">Confirm Password:</label>
              <input type="text" id="cPassword" v-model="cPassword" required>
              <button type="submit">Register</button>
            </form>
          </div>
        </div>
      </div>
    </background-scene>
    <footer-comp></footer-comp>
  </div>
</template>

<script>
import BackgroundScenery from "../general/BackgroundScenery.vue";
import FooterComponent from "../general/FooterComponent.vue";
import User from "../../models/User";
import axios from 'axios'; 

export default {
  name: 'UserRegister',
  components: { 
    'footer-comp': FooterComponent,
    'background-scene': BackgroundScenery
  },
  data() {
    return {
      user: new User('', '', '', '', '', '', '', ''), 
      cPassword: ''
    };
  },
  methods: {
    async registerUser() {
      if (this.user.password !== this.cPassword) {
        alert('Passwords do not match!');
        return;
      }
      try {
        
        const authResponse = await axios.post('https://identitytoolkit.googleapis.com/v1/accounts:signUp?key=AIzaSyBsQse1mKxQ1F7-l41RE1Oz4QhP91qgmLw', {
          email: this.user.email,
          password: this.user.password,
          returnSecureToken: true,
        });

        const userId = authResponse.data.localId;

        const firestoreResponse = await axios.post(
          `https://firestore.googleapis.com/v1/projects/clubbox-system/databases/(default)/documents/Student?documentId=${userId}`, 
          {
            fields: {
              firstName: { stringValue: this.user.firstName },
              lastName: { stringValue: this.user.lastName },
              matricNo: { stringValue: this.user.matricNo },
              yearCourse: { stringValue: this.user.yearCourse },
              phoneNumber: { stringValue: this.user.phoneNumber },
              address: { stringValue: this.user.address },
              utmEmail: { stringValue: this.user.email },
              password: { stringValue: this.user.password }
            }
          },
          {
            headers: {
              Authorization: `Bearer ${authResponse.data.idToken}`
            }
          }
        );

        console.log('User registered and document added:', firestoreResponse.data);
        this.$router.push('/');
      } catch (error) {
        console.error('Error registering user:', error);
        
      }
    }
  }
}
</script>

<style scoped>
.main-container {
  position: relative;
  min-height: 113vh;
}

.container {
  width: 80vw;
  margin-top: 20vh;
  margin-bottom: 30vh;
  padding: 0;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  background-attachment: local;
  overflow: hidden;
}

.scrollable-box {
  width: 100%;
  overflow-y: hidden; 
  display: flex;
  margin-top: 10vh;
  height: calc(100vh - 50px); 
}

.left-box {
  width: 15%;
  padding: 1em;
  border-radius: 5px;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  background-color: rgba(128, 0, 0, 0.7);
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
  width:75%;
  display: flex;
  flex-direction: column;
  justify-content: left;
  margin-top: 7vh;
  
  
}
.top-form{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin-bottom: 2vh;
}

label {
  margin-bottom: 0.5em;
}

input {
  margin-bottom: 1em;
}

button {
  padding: 0.5em 1em;
  background-color: maroon;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>
