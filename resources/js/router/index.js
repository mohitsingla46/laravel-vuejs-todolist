import { createRouter, createWebHistory } from 'vue-router';
import TaskList from '../components/TaskList.vue';
import AddTask from '../components/AddTask.vue';
import EditTask from '../components/EditTask.vue';
import About from '../components/About.vue';

const routes = [
    { path: '/', name: 'TaskList', component: TaskList },
    { path: '/add', name: 'AddTask', component: AddTask },
    { path: '/edit/:id', name: 'EditTask', component: EditTask, props: true },
    { path: '/about', name: 'About', component: About },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
