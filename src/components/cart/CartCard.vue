<template>
    <div class="cart-card">
      <p class="cart-title">{{ title }}</p>
      <p class="cart-price" v-if="typeof price === 'number'">RM {{ price.toFixed(2) }}</p>
    </div>
  </template>
  
  

  <script>
  export default {
    name: 'CartCard',
    props: {
      title: {
        type: String,
        required: true
      },
      price: {
        type: Number,
        required: true
      }
    }
  }
  </script>




<style>
.cart-card {
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 10px;
  margin: 10px;
  background-color: #f9f9f9;
  width: 90%;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.cart-title {
  font-size: 1.2em;
  font-weight: bold;
}

.cart-price {
  font-size: 1em;
  color: #333;
}
</style>