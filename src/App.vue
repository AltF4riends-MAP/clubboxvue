<template>
  <div id="app">
    <router-view :cart="cart" @add-cart="handleAddToCart"></router-view>
  </div>
</template>

<script>
export default {
  name: 'App',
  data() {
    return {
      cart: []
    };
  },
  methods: {
    handleAddToCart(eventDetail) {
      this.cart.push(eventDetail);
      console.table(this.cart);
    }
  }
};
</script>


<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin: 0;
  position:relative;

}
body{
  margin: 0;
}
</style>
