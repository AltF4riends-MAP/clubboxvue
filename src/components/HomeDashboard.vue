<template>
  <div class="main-container">

    <header-comp :cart-item-count="cart.length"></header-comp>
    <background-scene>
      <div class="scrollable-box">
        <div class="event-list">
          <event-card
            v-for="event in events"
            :key="event.id"
            :title="event.title"
            :date="event.date"
            :description="event.description"
            :price="event.price"
            :image="event.image"
            @add-cart="handleAddToCart"
          />
        </div>
      </div>
    </background-scene>
    <footer-comp></footer-comp>
  </div>
</template>

<script>
import BackgroundScenery from './general/BackgroundScenery.vue';
import FooterComponent from './general/FooterComponent.vue';
import HeaderComponent from './general/HeaderComponent.vue';
import EventCard from './event/EventCard.vue';

export default {
  name: 'HomeDashboard',
  components: {
    'footer-comp': FooterComponent,
    'background-scene': BackgroundScenery,
    'header-comp': HeaderComponent,
    'event-card': EventCard
  },
  props: {
    cart: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      events: [
        {
          id: 1,
          title: 'ClubBox Workshop',
          date: 'June 10, 2024',
          description: 'A workshop on the ClubBox Management.',
          price: 12.00,
          image: require('../assets/clubbox.jpeg')
        },
        {
          id: 2,
          title: 'UTM Workshop',
          date: 'June 15, 2024',
          description: 'A workshop to learn about the greatness of UTM.',
          price: 5.00,
          image: require('../assets/logo.png')
        }
      ]
    };
  },
  methods: {
    handleAddToCart(eventDetail) {
      this.$emit('add-cart', eventDetail);
    }
  }
};
</script>

<style scoped>
.main-container {
  position: relative;
  min-height: 113vh;
}

.scrollable-box {
  width: 110%;
  overflow-y: hidden;
  display: flex;
  justify-content: center;
  align-items: center;
  margin-top: 10vh;
}

.event-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  width: 90%;
  height: 80vh;
}
</style>
