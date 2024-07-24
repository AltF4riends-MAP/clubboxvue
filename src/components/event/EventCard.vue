<template>
  <div class="event-card">
    <img v-if="image" :src="image" alt="Event Image" class="event-image"/>
    <div class="event-details">
      <h2 class="event-title">{{ title }}</h2>
      <p class="event-date">{{ date }}</p>
      <p class="event-description">{{ description }}</p>
      <b><p class="event-price">RM {{ price }}</p></b>
      <button @click="process">Join Event</button>
    </div>
  </div>
</template>

<script>
export default {
  name: 'EventCard',
  props: {
    title: {
      type: String,
      required: true
    },
    date: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: true
    },
    price: {
      type: Number,
      required: true
    },
    image: {
      type: String,
      required: false
    }
  },
  emits: ["add-cart"],
  methods: {
    process() {
      const eventDetail = {
        eventTitle: this.title,
        eventDate: this.date,
        eventDescription: this.description,
        eventPrice: this.price,
        eventImage: this.image,
      };
      this.$emit("add-cart", eventDetail);
    },
  },
};
</script>

<style scoped>
.event-card {
  border: 1px solid #ddd;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  margin: 10px;
  padding: 20px;
  display: flex;
  flex-direction: column;
  align-items: center;
  overflow: hidden;
  transition: box-shadow 0.3s;
  background-color: white;
  width: 20%;
  height: 60vh;
}

.event-card:hover {
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

.event-image {
  width: 12vw;
  height: 24vh;
  border-bottom: 1px solid #ddd;
}

.event-details {
  padding: 10px;
  text-align: center;
}

.event-title {
  font-size: 1.3em;
  margin: 10px 0;
}

.event-date {
  color: gray;
  margin-bottom: 10px;
}

.event-description {
  font-size: 1em;
  color: #333;
}

.event-price {
  padding: -20px;
  font-size: 1em;
  color: #333;
}

button {
  margin-top: 10px;
  padding: 10px 20px;
  background-color: #007bff;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #0056b3;
}
</style>
