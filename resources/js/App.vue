<template>
    <div>
        <header>
            <h1>Task Manager</h1>
            <nav>
                <router-link to="/">Task List</router-link>
                <router-link to="/about">About</router-link>
            </nav>
        </header>
        <main>
            <!-- Render the component based on the current route -->
            <router-view />
        </main>
    </div>
</template>

<script>
export default {
    name: 'App',
};
</script>

<style scoped>
/* Layout and general styling */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
    color: #333;
}

#app {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}

/* Header styling */
header {
    background-color: #007bff;
    color: white;
    padding: 1rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

header h1 {
    margin: 0;
    font-size: 1.5rem;
}

header nav a {
    color: white;
    text-decoration: none;
    margin-right: 1rem;
    font-size: 1rem;
}

header nav a.router-link-active {
    text-decoration: underline;
}

/* Main content styling */
main {
    flex: 1;
    padding: 2rem;
    max-width: 800px;
    margin: 0 auto;
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Footer styling */
footer {
    background-color: #007bff;
    color: white;
    text-align: center;
    padding: 1rem 0;
    font-size: 0.875rem;
}
</style>
