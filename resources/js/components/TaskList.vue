<template>
    <div class="trello-board">
        <h1>Task List</h1>
        <router-link to="/add" class="add-task-btn">
            <button>Add New Task</button>
        </router-link>
        <div class="columns">
            <div v-for="status in statuses" :key="status" class="column">
                <h2>{{ formatStatus(status) }}</h2>
                <draggable v-model="tasksByStatus[status]" item-key="id" tag="ul"
                    :group="{ name: 'tasks', pull: true, put: true }" @change="handleTaskMove(status, $event)">
                    <template #item="{ element: task }">
                        <li class="task">
                            <div class="task-content">
                                <h4>{{ task.title }}</h4>
                                <p>{{ task.description }}</p>
                            </div>
                            <div class="task-actions">
                                <button class="btn btn-edit" @click="editTask(task.id)">Edit</button>
                                <button class="btn btn-delete" @click="deleteTask(task.id)">Delete</button>
                            </div>
                        </li>
                    </template>
                </draggable>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import draggable from 'vuedraggable';
import axios from 'axios';
import { useRouter } from 'vue-router';

const router = useRouter();

// Statuses for tasks
const statuses = ['todo', 'in_progress', 'completed'];

// Reactive state for tasks
const tasks = ref([]);
const tasksByStatus = computed(() => {
    return statuses.reduce((acc, status) => {
        acc[status] = tasks.value.filter(task => task.status === status);
        return acc;
    }, {});
});

// Fetch tasks on component mount
const fetchTasks = async () => {
    try {
        const response = await axios.get('/api/tasks');
        tasks.value = response.data;
    } catch (error) {
        console.error('Error fetching tasks:', error);
    }
};

// Handle task movement between statuses
const handleTaskMove = async (status, event) => {
    if (event.added || event.moved) {
        console.log(status);

        const { newIndex, element } = event.added || event.moved;

        try {
            await axios.post(`/api/update_task_status`, {
                id: element.id,
                status: status
            });

            // Update local state
            const taskIndex = tasks.value.findIndex(t => t.id === element.id);
            if (taskIndex !== -1) {
                tasks.value[taskIndex].status = status;
            }
        } catch (error) {
            console.error('Error moving task:', error);
        }
    }
};

const formatStatus = (status) => {
    return status
        .split('_')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join(' ');
}

const deleteTask = async (id) => {
    try {
        await axios.delete(`/api/tasks/${id}`);
        tasks.value = tasks.value.filter(task => task.id !== id);
    } catch (error) {
        console.error('Error deleting task:', error);
    }
};

const editTask = (id) => {
    router.push({ name: 'EditTask', params: { id } });
}

onMounted(fetchTasks);
</script>

<style scoped>
/* General Board Styling */
.trello-board {
    padding: 20px;
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
    width: 100%;
    /* Ensures the board takes full page width */
}

h1 {
    font-size: 1.5rem;
    color: #007bff;
    margin-bottom: 1.5rem;
    text-align: center;
}

/* Columns */
.columns {
    display: flex;
    gap: 20px;
    justify-content: space-evenly;
    /* Equal spacing between columns */
    width: 100%;
    /* Ensures columns fit horizontally without scrolling */
}

.column {
    background-color: #ffffff;
    border: 1px solid #ddd;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    padding: 15px;
    width: calc(100% / 3 - 40px);
    /* Dynamic column width based on 3 sections */
    min-height: 500px;
    display: flex;
    flex-direction: column;
}

/* Column Header */
h2 {
    font-size: 1.25rem;
    color: #007bff;
    margin-bottom: 1rem;
    text-align: center;
    border-bottom: 2px solid #ddd;
    padding-bottom: 5px;
}

/* Tasks List */
.task {
    background-color: #f9f9f9;
    padding: 10px 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
    display: flex;
    flex-direction: column;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.task:hover {
    transform: scale(1.02);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
}

/* Task Content */
.task-content h4 {
    font-size: 1.1rem;
    margin: 0;
    color: #333;
    font-weight: bold;
}

.task-content p {
    margin: 0.5rem 0 0 0;
    font-size: 0.9rem;
    color: #666;
    line-height: 1.4;
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

/* Task Actions */
.task-actions {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.btn {
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 0.875rem;
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

/* Responsiveness */
@media (max-width: 1024px) {
    .columns {
        flex-wrap: wrap;
        /* Allows columns to wrap if screen size is small */
        justify-content: center;
    }

    .column {
        width: 90%;
        /* Full width for mobile screens */
        max-width: 400px;
        margin-bottom: 20px;
    }
}
</style>