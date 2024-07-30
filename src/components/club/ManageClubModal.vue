<template>
    <div class="modal" v-if="visible">
      <div class="modal-content">
        <span class="close" @click="close">&times;</span>
        <h2>Manage Club</h2>
        <form @submit.prevent="updateClub">
          <div>
            <label for="name">Name:</label>
            <input type="text" id="name" v-model="localClub.name" required />
          </div>
          <div>
            <label for="description">Description:</label>
            <textarea id="description" v-model="localClub.description" required></textarea>
          </div>
          <div>
            <label for="image">Image:</label>
            <input type="file" id="image" @change="onFileChange" />
          </div>
          <button type="submit">Save Changes</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';

  export default {
    name: 'ManageClubModal',
    props: {
      club: {
        type: Object,
        required: true
      },
      visible: {
        type: Boolean,
        required: true
      }
    },
    data() {
      return {
        localClub: { ...this.club }
      };
    },
    watch: {
      club: {
        handler(newClub) {
          this.localClub = { ...newClub };
        },
        deep: true
      }
    },
    methods: {
      close() {
        this.$emit('close');
      },
      onFileChange(e) {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onload = (event) => {
          this.localClub.image = event.target.result;
        };
        reader.readAsDataURL(file);
      },
      async updateClub() {
        try {
          const formData = new FormData();
          formData.append('id', this.localClub.id);
          formData.append('name', this.localClub.name);
          formData.append('description', this.localClub.description);
          formData.append('image', this.localClub.image);
          
          const response = await axios.post('http://localhost/ClubBoxPHP/club', formData);
          if (response.data.success) {
            this.$emit('update', this.localClub);
            this.close();
          } else {
            console.error('Error updating club:', response.data.error);
          }
        } catch (error) {
          console.error('Error updating club:', error);
        }
      }
    }
  };
  </script>
  
  <style>
  .modal {
    display: block;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.4);
  }
  
  .modal-content {
    background-color: #fefefe;
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
  }
  
  .close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }
  
  .close:hover,
  .close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
  }
  
  form div {
    margin-bottom: 10px;
  }
  
  button {
    margin-top: 10px;
    padding: 10px 20px;
    background-color: maroon;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }
  
  button:hover {
    background-color: darkgreen;
  }
  </style>
  