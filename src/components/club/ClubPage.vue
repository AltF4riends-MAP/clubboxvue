<template>
    <div class="main-container">
    <header-comp :cart-item-count="cart.length"></header-comp>
    <background-scene>
        <div class="scrollable-box">
            <div class="club-list">
          <club-card
            v-for="club in clubs"
            :key="club.id"
            :title="club.title"
            :description="club.description"
            :image="club.image"
          />
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
import ClubCard from './ClubCard.vue';


export default {
  name: 'ClubPage',
  props: {
    cart: {
      type: Array,
      required: true
    }
  },

  data(){
    return{
        clubs: [
        {
          id: 1,
          title: 'AltF4riends',
          description: 'Where all friends meet outside',
          image: require('../../assets/friends.png')
        },
        {
          id: 2,
          title: 'Unite Club',
          description: 'United we stand, Devided we fall',
          image: require('../../assets/unity.png')
        }
      ]
    }
  },
  components: {
    'footer-comp': FooterComponent,
    'background-scene': BackgroundScenery,
    'header-comp': HeaderComponent,
    'club-card': ClubCard,

  },
}

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