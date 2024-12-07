<template>
    <div>
        <h2>Task List</h2>
        <router-link to="/add" class="add-task-btn">
            <button>Add New Task</button>
        </router-link>
        <ul>
            <li v-for="task in tasks" :key="task.id" class="task-item">
                <div>
                    <strong>{{ task.title }}</strong>
                    <p>{{ task.description }}</p>
                </div>
                <div>
                    <button @click="editTask(task.id)" class="btn btn-edit">Edit</button>
                    <button @click="deleteTask(task.id)" class="btn btn-delete">Delete</button>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            tasks: [],
        };
    },
    methods: {
        async fetchTasks() {
            const response = await axios.get('/api/tasks');
            this.tasks = response.data;
        },
        async deleteTask(id) {
            await axios.delete(`/api/tasks/${id}`);
            this.tasks = this.tasks.filter(task => task.id !== id);
        },
        editTask(id) {
            this.$router.push({ name: 'EditTask', params: { id } });
        },
    },
    mounted() {
        this.fetchTasks();
    },
};
</script>

<style scoped>
h2 {
    font-size: 1.5rem;
    color: #007bff;
    margin-bottom: 1rem;
}

ul {
    list-style: none;
    padding: 0;
}

.task-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    margin-bottom: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px;
    background-color: #f9f9f9;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.task-item strong {
    font-size: 1.2rem;
}

.task-item p {
    margin: 0.5rem 0 0 0;
    font-size: 0.9rem;
    color: #666;
}

/* Buttons */
.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.875rem;
    margin-left: 0.5rem;
}

.btn-edit {
    background-color: #007bff;
    color: white;
}

.btn-delete {
    background-color: #ff4d4d;
    color: white;
}

.btn:hover {
    opacity: 0.9;
}

.add-task-btn {
    margin-bottom: 1rem;
    display: inline-block;
}

.add-task-btn button {
    background-color: #28a745;
    color: white;
    padding: 10px 15px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.add-task-btn button:hover {
    background-color: #218838;
}
</style>