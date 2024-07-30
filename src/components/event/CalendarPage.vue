<template>
  <div class="main-container">
    <header-comp :cart-item-count="cart.length"></header-comp>
    <background-scene>
      <div class="calendar">
        <h1>Calendar</h1>
        <div class="header">
          <button @click="prevMonth">&lt;</button>
          <h2>{{ currentMonth }}</h2>
          <button @click="nextMonth">&gt;</button>
        </div>
        <div class="days">
          <div class="day" v-for="day in daysOfWeek" :key="day">{{ day }}</div>
          <div v-for="blank in blanks" :key="blank" class="empty"></div>
          <div
            v-for="date in daysInMonth"
            :key="date"
            class="day"
            :class="{ 'today': isToday(date), 'selected': isSelected(date) }"
            @click="selectDate(date)"
          >
            {{ date }}
            <div v-for="event in eventsOnDate(date)" :key="event.id" class="event">
              {{ event.name }}
            </div>
          </div>
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

export default {
  name: "CalendarPage",
  components: {
    'footer-comp': FooterComponent,
    'background-scene': BackgroundScenery,
    'header-comp': HeaderComponent,
  },
  data() {
    return {
      currentDate: new Date(),
      selectedDate: null,
      events: []
    };
  },
  computed: {
    currentMonth() {
      return this.currentDate.toLocaleString('default', { month: 'long', year: 'numeric' });
    },
    daysOfWeek() {
      return ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    },
    daysInMonth() {
      const year = this.currentDate.getFullYear();
      const month = this.currentDate.getMonth();
      const days = new Date(year, month + 1, 0).getDate();
      return Array.from({ length: days }, (_, index) => index + 1);
    },
    blanks() {
      const year = this.currentDate.getFullYear();
      const month = this.currentDate.getMonth();
      const firstDayOfMonth = new Date(year, month, 1).getDay();
      return Array.from({ length: firstDayOfMonth }, (_, index) => index);
    }
  },
  props: {
    cart: {
      type: Array,
      required: true
    }
  },
  created() {
    this.fetchEvents();
  },
  methods: {
    async fetchEvents() {
      try {
        const response = await axios.get('http://localhost/ClubBoxPHP/clubevent');
        this.events = response.data;
      } catch (error) {
        console.error('Error:', error);
      }
    },
    prevMonth() {
      this.currentDate = new Date(this.currentDate.setMonth(this.currentDate.getMonth() - 1));
    },
    nextMonth() {
      this.currentDate = new Date(this.currentDate.setMonth(this.currentDate.getMonth() + 1));
    },
    isToday(date) {
      const today = new Date();
      return (
        date === today.getDate() &&
        this.currentDate.getMonth() === today.getMonth() &&
        this.currentDate.getFullYear() === today.getFullYear()
      );
    },
    isSelected(date) {
      return this.selectedDate === date;
    },
    selectDate(date) {
      this.selectedDate = date;
    },
    eventsOnDate(date) {
      const month = this.currentDate.getMonth() + 1;
      const year = this.currentDate.getFullYear();
      const dateString = `${year}-${month.toString().padStart(2, '0')}-${date.toString().padStart(2, '0')}`;
      return this.events.filter(event => event.date.startsWith(dateString));
    }
  }
};
</script>

<style scoped>
.main-container {
  position: relative;
  min-height: 113vh;
}

.calendar {
  font-family: Arial, sans-serif;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;
  width: 80%;
  height: auto;
  background-color: aliceblue;
  margin-top: 20px;
}

.header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.days {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  grid-gap: 5px;
  border: solid 2px black;
  padding: 5px;
}

.day {
  text-align: center;
  padding: 5px;
  cursor: pointer;
  background-color: lightgray;
  border: solid 1px black;
}

.empty {
  visibility: hidden;
}

.today {
  background-color: yellow;
}

.selected {
  background-color: #66b3ff;
  color: white;
}

.event {
  font-size: 0.8em;
  background-color: blue;
  margin-top: 5px;
  padding: 2px;
  border-radius: 3px;
  color: white;
}
</style>
