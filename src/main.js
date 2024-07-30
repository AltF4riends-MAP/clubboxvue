import { createApp } from 'vue'
import { VueFire, VueFireAuth } from 'vuefire'
import App from './App.vue'
import { firebaseApp } from './firebase'
import router from './router';
import store from './store';

const app = createApp(App)
app.use(VueFire, {
  
  firebaseApp,
  modules: [
    VueFireAuth(),
  ],
})

app.use(router);
app.use(store); 

app.mount('#app')