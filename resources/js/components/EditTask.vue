<template>
    <div class="task-form">
        <h2>Edit Task</h2>
        <form @submit.prevent="updateTask">
            <div class="form-group">
                <label for="title">Task Title</label>
                <input type="text" id="title" v-model="currentTask.title" required />
            </div>
            <div class="form-group">
                <label for="description">Task Description</label>
                <textarea id="description" v-model="currentTask.description"></textarea>
            </div>
            <div class="form-actions">
                <button type="submit" class="btn btn-submit">Update Task</button>
                <router-link to="/" class="btn btn-cancel">Cancel</router-link>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['id'],
    data() {
        return {
            currentTask: {
                title: '',
                description: ''
            },
        };
    },
    async mounted() {
        // Fetch the task based on the id prop
        const response = await axios.get(`/api/tasks/${this.id}`);
        this.currentTask = response.data;
    },
    methods: {
        async updateTask() {
            const response = await axios.put(`/api/tasks/${this.currentTask.id}`, this.currentTask);
            this.$router.push('/'); // Redirect to task list after updating
        },
    },
};
</script>

<style scoped>
.task-form {
    max-width: 600px;
    margin: 0 auto;
    padding: 2rem;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #007bff;
    margin-bottom: 1.5rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

input, textarea {
    width: 100%;
    padding: 0.75rem;
    font-size: 1rem;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-sizing: border-box;
}

textarea {
    resize: vertical;
    min-height: 120px;
}

.form-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    cursor: pointer;
}

.btn-submit {
    background-color: #007bff;
    color: white;
}

.btn-cancel {
    background-color: #f44336;
    color: white;
    text-decoration: none;
    text-align: center;
}

.btn:hover {
    opacity: 0.8;
}
</style>