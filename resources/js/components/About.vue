<template>
    <div>
        <h1>About Task Manager</h1>
        <p>
            This Task Manager application helps you organize your tasks efficiently. 
            You can create, update, and delete tasks effortlessly!
        </p>
        <router-link to="/">Back to Task List</router-link>
    </div>
</template>

<script>
export default {
    name: 'About',
};
</script>

<style scoped>
h1 {
    color: green;
}
p {
    font-size: 1.1rem;
}
</style>
