<template>
    <div class="main-container">
        <header-comp :cart-item-count="cart.length"></header-comp>
        <background-scenery>
            <div class="container">
                <div class="scrollable-box">
                    <div class="innerbox">
                    <h1>Add Event</h1>
                    <form @submit.prevent="addEventInfo">

                        <div class="top-form">
                            <label for="eventName">Event Name:</label>
                            <input type="text" id="eventName" v-model="eventName" required>
                        </div>

                        <label for="eventDesc">Event Description:</label>
                        <textarea label="Event Description" id="eventDesc" v-model="eventDesc" required></textarea>

                        <div class="top-form">
                            <label for="eventShortDesc">Event Short Description:</label>
                            <input type="text" id="eventShortDesc" v-model="eventShortDesc" required>
                            
                            <label for="eventType">Event Type:</label>
                            <input type="text" id="eventType" v-model="eventType" required>
                        </div>

                        <div class="top-form">
                            <label for="eventName">Event Date:</label>
                            <input type="text" id="eventDate" v-model="eventDate" required>
                            
                            <label for="eventTime">Event Time:</label>
                            <input type="text" id="eventTime" v-model="eventTime" required>
                        </div>

                        <label for="eventPrice">Event Price:</label>
                        <input type="" id="eventPrice" v-model="eventPrice" required>

                        <button type="submit">Add Event</button>
                    </form>
                    </div>
                </div>
            </div>
        </background-scenery>
        <footer-comp></footer-comp>
    </div>
</template>

<script>
import BackgroundScenery from '../general/BackgroundScenery.vue';
import FooterComponent from '../general/FooterComponent.vue';
import axios from 'axios'; 
import HeaderComponent from '../general/HeaderComponent.vue';


export default {
    name: 'AddEvent',
    props: {
    cart: {
      type: Array,
      required: true
    }
  },
    components: {
        'footer-comp': FooterComponent,
        'background-scenery': BackgroundScenery,
        'header-comp': HeaderComponent
    },
    data() {
        return{
            eventName: '',
            eventDesc: '',
            eventDate: '',
            eventType: '',
            eventShortDesc: '',
            eventTime: '',
            eventPrice: 0,
        };
    },
    methods:{

        async addEventInfo() {
            try{

                const dbResponse = await axios.post('http://localhost/ClubBoxPHP/clubevent', {
                  eventName: this.eventName,
                  eventDesc: this.eventDesc,
                  eventDate: this.eventDate,
                  eventType: this.eventType,
                  eventShortDesc: this.eventShortDesc,
                  eventTime: this.eventTime,
                  eventPrice: this.eventPrice,
            });
            
            console.log('Event Data Added: ', dbResponse.data);
            this.$router.push('/dashboard');

            } catch(error) {
                console.error("why" + error);
            }
        }
    },

};
</script>

<style scoped>
.main-container {
  position: relative;
  min-height: 113vh;
}

.container {
  width: 80vw;
  margin-top: 20vh;
  margin-bottom: 30vh;
  padding: 0;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: row;
  justify-content: center;
  align-items: center;
  background-attachment: local;
  overflow: hidden;
}

.scrollable-box {
  width: 100%;
  overflow-y: hidden; 
  display: flex;
  margin-top: 10vh;
  height: calc(100vh - 50px); 
}

.innerbox {
    width: 85%;
  padding: 1em;
  border-radius: 5px;
  border-top-left-radius: 0;
  border-bottom-left-radius: 0;
  background-color: white;
  display: flex;
  flex-direction: column;
  align-items: center;
}

form {
  width:75%;
  display: flex;
  flex-direction: column;
  justify-content: left;
  margin-top: 7vh; 
}

.top-form{
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  margin-bottom: 2vh;
}

label {
  margin-bottom: 0.5em;
}

input {
  margin-bottom: 1em;
}

textarea {
  margin-bottom: 1em;
}

button {
  padding: 0.5em 1em;
  background-color: maroon;
  color: white;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
</style>