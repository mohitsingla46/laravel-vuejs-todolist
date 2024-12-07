import { createApp } from 'vue';
import App from './App.vue'; // Root component
import router from './router'; // Vue Router setup

// Initialize the Vue app
createApp(App).use(router).mount('#app');
