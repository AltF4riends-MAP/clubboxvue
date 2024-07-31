<template>
  <div class="header">
    <div class="left-box">
      <img src="../../assets/clubbox.jpeg" class="logo" alt="Logo">
      <h1 class="header-title">ClubBox System</h1>
    </div>
    <div class="right-box">
      <nav>
        <ul class="nav-links">
          <li><router-link to="/dashboard">Home</router-link></li>
          <li class="cart">
            <router-link to="/cart">Cart</router-link>
            <span v-if="cartItemCount > 0" class="badge">{{ cartItemCount }}</span>
          </li>
          <li><router-link to="/club">Club</router-link></li>
          <li><router-link to="/calendar">Calendar</router-link></li>
          <li><router-link to="/faq">FAQ</router-link></li>
          <li><router-link to="/addevent">Add Event</router-link></li>
          <li class="menu">
            <i class="fas fa-user-circle icon" @click="toggleDropdown"><img class="user" src="../../assets/user.png"></i>
            <ul v-if="dropdownVisible" class="dropdown-menu">
              <li><router-link to="/profile">Manage Profile</router-link></li>
              <li @click="logout">Logout</li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>

<script>
export default {
  name: 'HeaderComponent',
  props: ['cartItemCount'],
  data() {
    return {
      dropdownVisible: false
    };
  },
  methods: {
    toggleDropdown() {
      this.dropdownVisible = !this.dropdownVisible;
    },
    logout() {
      console.log('Logging out...');
      this.$router.push('/');
    }
  }
};
</script>

<style scoped>
.header {
  background-color: #333;
  color: white;
  width: 100%;
  position: fixed;
  top: 0;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 20px;
  box-sizing: border-box;
  z-index: 1000;
}

.left-box, .right-box {
  display: flex;
  align-items: center;
}

.left-box {
  flex: 1;
  display: flex;
  align-items: center;
}

.right-box {
  flex: 1;
  display: flex;
  justify-content: flex-end;
}

.logo {
  width: 50px;
  height: auto;
  margin-right: 10px;
}

.header-title {
  font-size: 1.5em;
  margin: 0;
}

.nav-links {
  list-style: none;
  display: flex;
  gap: 20px;
}

.nav-links li {
  display: inline;
}

.nav-links a {
  color: white;
  text-decoration: none;
  font-size: 1em;
  transition: color 0.3s ease;
}

.nav-links a:hover {
  color: #007bff;
}

.menu {
  position: relative;
}

.icon {
  font-size: 2em;
  cursor: pointer;
  color: white;
  margin-left: 20px;
}

.dropdown-menu {
  position: absolute;
  right: 0;
  top: 100%;
  background-color: #444;
  color: white;
  list-style: none;
  padding: 10px;
  margin: 0;
  border-radius: 5px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
}

.dropdown-menu li {
  margin: 5px 0;
}

.dropdown-menu li a,
.dropdown-menu li {
  color: white;
  text-decoration: none;
  cursor: pointer;
}

.dropdown-menu li:hover {
  color: #007bff;
}

@media (max-width: 768px) {
  .nav-links {
    flex-direction: column;
    gap: 10px;
  }

  .right-box {
    justify-content: center;
  }
}

.user {
  width: 40px;
  height: 40px;
  margin-top: -18px;
}

.cart {
  position: relative;
}

.badge {
  position: absolute;
  top: -10px;
  right: -10px;
  background-color: red;
  color: white;
  border-radius: 50%;
  padding: 2px 6px;
  font-size: 0.8em;
}
</style>
