<template>
    <div class="main-container">
      <header-comp :cart-item-count="cart.length"></header-comp>
      <background-scene>
        <div class="scrollable-box">
            <div class="cart-box">
              <cart-card
                v-for="item in cart"
                :key="item.eventTitle"
                :title="item.eventTitle"
                :price="item.eventPrice"
              />
            </div>
            <div class="cart-box">
              <h2>Total Price: RM {{ total.toFixed(2) }}</h2>
            </div>
            <div class="cart-box">
              <v-btn @click="alertPayment">Pay</v-btn>
            </div>
        </div>
      </background-scene>
      <footer-comp></footer-comp>
    </div>
  </template>
  
  <script>
  import BackgroundScenery from '../general/BackgroundScenery.vue';
  import FooterComponent from '../general/FooterComponent.vue';
  import HeaderComponent from '../general/HeaderComponent.vue';
  import CartCard from './CartCard.vue';

  
  export default {
    name: 'CartPage',
    components: {
      'footer-comp': FooterComponent,
      'background-scene': BackgroundScenery,
      'header-comp': HeaderComponent,
      'cart-card': CartCard,
    },
    props: {
      cart: {
        type: Array,
        required: true
      }
    },
    data() {
      return {
        total: 0.0
      };
    },
    watch: {
      cart: {
        handler(newCart) {
          this.calculateTotal(newCart);
        },
        deep: true
      }
    },
    methods: {
      calculateTotal(cart) {
        this.total = cart.reduce((acc, item) => acc + Number(item.eventPrice), 0);
      },

      alertPayment()
      {
        this.$router.push('/dashboard');
      }
    },
    created() {
      this.calculateTotal(this.cart);
    }
  };
  </script>
  
  <style scoped>
  .main-container {
    position: relative;
    min-height: 113vh;
  }
  
  .scrollable-box {
    width: 100%;
    overflow-y: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    margin-top: 10vh;
  }
  
  .cart-box {
    margin-top: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 10px;
    background-color: #fff;
    width: 50%;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);

  }
  
  form {
  width:75%;
  display: flex;
  flex-direction: column;
  justify-content: left;
  margin-top: 7vh;
}

  .cart-card {
    margin-bottom: 10px;
  }

  v-btn {
  padding: 0.5em 1em;
  background-color: maroon;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
  </style>
  