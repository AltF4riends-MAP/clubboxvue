<template>
<div class="background">
  <div class="cover">

  
  <div class= "container">

    <div class="left-box">
      <h1 class="system">ClubBox System</h1>
      <h2 class="system2">"Unboxing The Abundance of Clubs"</h2>
      <img src="../../assets/group.png" height="200px" width="300px">
    
    </div>
    <div class="login-container">
        <h1>Login</h1>
        <form @submit.prevent="handleLogin">
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" v-model="email" required>
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" v-model="password" required>
          </div>
          <button type="submit">Login</button>
        </form>
        <button class="register" @click.prevent="registerPage()"><label>Register Here</label></button>
    </div>
  </div>
  </div>
</div>
</template>

<script>
import axios from 'axios';


export default {
  name: 'UserLogin',
  data() {
    return {
      email: '',
      password: ''
    }
  },
  methods: {
    async handleLogin() {
      try {
        const response = await axios.post('https://identitytoolkit.googleapis.com/v1/accounts:signInWithPassword?key=AIzaSyBsQse1mKxQ1F7-l41RE1Oz4QhP91qgmLw', {
          email: this.email,
          password: this.password,
          returnSecureToken: true
        });
        console.log('Logged in:', response.data);

        
        this.$router.push('/dashboard');
      } catch (error) {
        console.error('Error logging in:', error);
        alert('Login failed: ' + error.message);
      }
    },
    registerPage(){
      this.$router.push('/register');
    }
  },

  
}
</script>

<style scoped>

.background{
  width: 100vw;
  height: 100vh;
  margin:0;
  padding:0;
  display:flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.762);
  background-image: url("../../assets/utm.jpg");
  background-repeat: no-repeat;
  background-size:cover;
}
.cover{
  width: 100vw;
  height: 100vh;
  margin:0;
  padding:0;
  display:flex;
  align-items: center;
  justify-content: center;
  background-color: rgba(0, 0, 0, 0.5);
}
.container{
  width: 60vw;
  height: 60;
  margin: auto;
  
  padding: 0em;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: row;
}
.system{
  padding-top: 3vh;
  color: white;
  margin-bottom: 50px;
}
.system2{
  padding-top: 5vh;
  color: white;
  margin-bottom: 50px;
}
.left-box {
  width: 55vw;
  height: 80vh;
  margin: 0;
  margin-right: 0;
  padding: 1em;
  border-radius: 5px;
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
  background-color: maroon;
  
}
.login-container {
  width: 35vw;
  height: 58.5vh;
  margin: 0;
  margin-left: 0;
  padding: 5em;
  border-radius: 5px;
  border-top-left-radius: 0px;
  border-bottom-left-radius: 0px;
  background-color: white;
  
}

.form-group {
  margin-bottom: 1em;
}

label {
  display: block;
  margin-bottom: 0.5em;
}

input {
  width: 100%;
  padding: 0.5em;
  box-sizing: border-box;
}

button {
  width: 100%;
  padding: 0.7em;
  background-color: maroon;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

button:hover {
  background-color: darkred;
}

.register{
  color:white;
  margin-top: 20px;

}
.register:hover{
  color:blue;
}
</style>
