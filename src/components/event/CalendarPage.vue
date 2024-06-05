<template>
    <div class="main-container">
        <header-comp :cart-item-count="cart.length"></header-comp>
    <background-scene>
    <div class="calendar">
      <div class="header">
        <button @click="prevMonth">&lt;</button>
        <h2>{{ currentMonth }}</h2>
        <button @click="nextMonth">&gt;</button>
      </div>
      <div class="days">
        <div class="day" v-for="day in daysOfWeek" :key="day">{{ day }}</div>
        <div
          v-for="blank in blanks"
          :key="blank"
          class="empty"
        ></div>
        <div
          v-for="date in daysInMonth"
          :key="date"
          class="day"
          :class="{ 'today': isToday(date), 'selected': isSelected(date) }"
          @click="selectDate(date)"
        >
          {{ date }}
        </div>
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


  export default {
    name: "CalendarPage",
    components:{
        'footer-comp': FooterComponent,
    'background-scene': BackgroundScenery,
    'header-comp': HeaderComponent,
    },
    data() {
      return {
        currentDate: new Date(),
        selectedDate: null
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
    methods: {
      prevMonth() {
        this.currentDate.setMonth(this.currentDate.getMonth() - 1);
      },
      nextMonth() {
        this.currentDate.setMonth(this.currentDate.getMonth() + 1);
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
        const today = new Date();
        
   
        console.log(today.getDate())
        console.log(this.currentDate.getMonth())
        console.log(this.currentDate.getFullYear())
        console.log(this.currentDate.getDay())
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
    padding: 10px;
    width: 80%;
    height: auto;
    background-color: aliceblue;
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
  }
  
  .day {
    text-align: center;
    padding: 5px;
    cursor: pointer;
  }
  
  .empty {
    visibility: hidden;
  }
  
  .today {
    background-color: #ffe6e6;
  }
  
  .selected {
    background-color: #66b3ff;
    color: white;
  }
  
  button {
    background: none;
    border: none;
    cursor: pointer;
  }
  </style>
  