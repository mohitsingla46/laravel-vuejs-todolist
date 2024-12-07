import { createApp } from 'vue';
import App from './App.vue'; // Root component
import router from './router'; // Vue Router setup
import VueApexCharts from "vue3-apexcharts";

const app = createApp(App);

app.use(VueApexCharts);
app.use(router);

app.mount('#app');
