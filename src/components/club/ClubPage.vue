<template>
  <div class="main-container">
    <header-comp :cart-item-count="cart.length"></header-comp>
    <background-scene>
      <div class="scrollable-box">
        <div class="club-list">
          <club-card
            v-for="club in clubs"
            :key="club.id"
            :title="club.name"
            :description="club.description"
            :image="club.image"
            :club="club"
            @update="updateClub"
          />
        </div>
      </div>
    </background-scene>
    <footer-comp></footer-comp>
  </div>
</template>

<script>
import axios from 'axios';
import BackgroundScenery from '../general/BackgroundScenery.vue';
import FooterComponent from '../general/FooterComponent.vue';
import HeaderComponent from '../general/HeaderComponent.vue';
import ClubCard from './ClubCard.vue';

export default {
  name: 'ClubPage',
  props: {
    cart: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      clubs: []
    };
  },
  created() {
    this.fetchClubs();
  },
  methods: {
    async fetchClubs() {
      try {
        const response = await axios.get('http://localhost/ClubBoxPHP/club');
        console.log('Response:', response); // Log the entire response object
        this.clubs = response.data.map(club => ({
          ...club,
          image: `data:image/jpeg;base64,${club.image}`
        }));
      } catch (error) {
        console.error('Error fetching club data:', error);
      }
    },
    updateClub(updatedClub) {
      const index = this.clubs.findIndex(club => club.id === updatedClub.id);
      if (index !== -1) {
        this.clubs.splice(index, 1, updatedClub);
      }
    }
  },
  components: {
    'footer-comp': FooterComponent,
    'background-scene': BackgroundScenery,
    'header-comp': HeaderComponent,
    'club-card': ClubCard,
  },
};
</script>

<style>
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
  margin-top: 10vh;
}

.club-list {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 20px;
  width: 90%;
  height: 80vh;
}
</style>
