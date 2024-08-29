<script setup>
import Backend from "../../Layouts/Backend.vue";

defineOptions({ layout: Backend })

</script>

<template>

    <Head title="| Dashboard" />
    <div class="container mx-auto py-10 px-4">
        <nav class="text-sm mb-4" aria-label="Breadcrumb">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center">
                    <a href="#" class="text-gray-500 hover:text-gray-700">Home</a>
                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li>
                    <span class="text-gray-700 font-medium">Dashboard</span>
                </li>
            </ol>
        </nav>
        <h1 class="text-3xl font-bold mb-8">Dashboard</h1>
        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold mb-3">Total Users</h2>
                <p class="text-3xl font-bold text-blue-600">1,234</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold mb-3">Revenue</h2>
                <p class="text-3xl font-bold text-green-600">$45,678</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold mb-3">New Orders</h2>
                <p class="text-3xl font-bold text-yellow-600">89</p>
            </div>
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold mb-3">Conversion Rate</h2>
                <p class="text-3xl font-bold text-purple-600">3.2%</p>
            </div>
        </div>

        <!-- Graphs -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            <!-- Line Graph -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-6">Monthly Sales</h2>
                <div class="h-80 bg-gray-100 rounded-md"></div>
            </div>

            <!-- Bar Graph -->
            <div class="bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-xl font-semibold mb-6">Top Products</h2>
                <div class="h-80 bg-gray-100 rounded-md"></div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
