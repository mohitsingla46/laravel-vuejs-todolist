<template>
    <div>
        <h2>Stacked Column Chart</h2>

        <!-- Checkbox Filters -->
        <div class="filters">
            <label>Filter by Products:</label>
            <div class="checkbox-group">
                <label v-for="product in allProducts" :key="product" class="checkbox-item">
                    <input type="checkbox" :value="product" v-model="selectedProducts" @change="filterProducts" />
                    {{ product }}
                </label>
            </div>
        </div>

        <!-- Chart -->
        <apexchart type="bar" :options="chartOptions" :series="filteredSeries" height="400"></apexchart>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // Data series for the chart
            allSeries: [
                { name: 'Product A', data: [30, 40, 45, 50, 49, 60, 70, 91] },
                { name: 'Product B', data: [23, 12, 54, 61, 32, 56, 81, 19] },
                { name: 'Product C', data: [12, 14, 23, 34, 54, 23, 12, 45] },
            ],
            filteredSeries: [], // Will hold the filtered data
            allProducts: ['Product A', 'Product B', 'Product C'], // List of all products
            selectedProducts: [], // Selected products for filtering
            // Chart configuration
            chartOptions: {
                chart: {
                    type: 'bar',
                    stacked: true, // Enable stacked columns
                    toolbar: { show: true },
                    zoom: { enabled: true },
                },
                responsive: [
                    {
                        breakpoint: 480,
                        options: {
                            legend: {
                                position: 'bottom',
                                offsetX: -10,
                                offsetY: 0,
                            },
                        },
                    },
                ],
                plotOptions: {
                    bar: {
                        horizontal: false, // Set to true for horizontal bars
                        borderRadius: 4,
                    },
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'], // X-axis labels
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'left',
                },
                fill: {
                    opacity: 1, // Ensure full color opacity
                },
            },
        };
    },
    methods: {
        // Filter data based on selected products
        filterProducts() {
            if (this.selectedProducts.length === 0) {
                // If no products selected, show all
                this.filteredSeries = this.allSeries;
            } else {
                // Show only selected products
                this.filteredSeries = this.allSeries.filter((series) =>
                    this.selectedProducts.includes(series.name)
                );
            }
        },
    },
    mounted() {
        // Initialize the chart with all data
        this.filteredSeries = this.allSeries;
    },
};
</script>

<style scoped>
h2 {
    text-align: center;
    margin-bottom: 20px;
}

.filters {
    margin: 20px 0;
    text-align: center;
}

.checkbox-group {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 10px;
}

.checkbox-item {
    display: flex;
    align-items: center;
    font-size: 16px;
}

.checkbox-item input {
    margin-right: 5px;
}
</style>