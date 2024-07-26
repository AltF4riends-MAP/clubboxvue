<template>
  <div class="main-container">
    <header-comp :cart-item-count="cart.length"></header-comp>
    <background-scene>
      <div class="scrollable-box">
        <div class="event-list">
          <event-card
            v-for="event in paginatedEvents"
            :key="event.id"
            :title="event.name"
            :date="event.date"
            :description="event.shortDescription"
            :price="event.price"
            :image="event.image"
            @add-cart="handleAddToCart"
          />
        </div>
        <div class="pagination-controls">
          <button @click="prevPage" :disabled="currentPage === 1">Back</button>
          <button @click="nextPage" :disabled="currentPage >= maxPage">Next</button>
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
import axios from 'axios';

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
      events: [],
      currentPage: 1,
      eventsPerPage: 3
    };
  },
  computed: {
    maxPage() {
      return Math.ceil(this.events.length / this.eventsPerPage);
    },
    paginatedEvents() {
      const start = (this.currentPage - 1) * this.eventsPerPage;
      const end = start + this.eventsPerPage;
      return this.events.slice(start, end);
    }
  },
  methods: {
    handleAddToCart(eventDetail) {
      this.$emit('add-cart', eventDetail);
    },

    async handleEvent() {
      try {
        const response = await axios.get('http://localhost/ClubBoxPHP/clubevent');
        this.events = response.data.map(event => ({
          ...event,
          image: `data:image/jpeg;base64,${event.image}`
        }));
      } catch (error) {
        console.error('Error fetching Events:', error);
      }
    },

    nextPage() {
      if (this.currentPage < this.maxPage) {
        this.currentPage++;
      }
    },

    prevPage() {
      if (this.currentPage > 1) {
        this.currentPage--;
      }
    }
  },
  mounted() {
    this.handleEvent();
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
  flex-direction: column;
  align-items: center;
  margin-top: 10vh;
}

.event-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 10px;
  width: 90%;
  height: 70vh;
}

.pagination-controls {
  display: flex;
  justify-content: center;
  gap: 10px;
  margin-top: 5px;
}

button {
  padding: 5px 5px;
  font-size: 16px;
  cursor: pointer;
  color: black;
  background-color: white
}

button:disabled {
  cursor: not-allowed;
  opacity: 0.6;
}
</style>
