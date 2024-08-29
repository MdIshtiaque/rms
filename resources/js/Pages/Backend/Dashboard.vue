<script setup>
import Backend from "../../Layouts/Backend.vue";
defineOptions({ layout: Backend });
import { ref, onMounted } from 'vue';
import { Chart, registerables } from 'chart.js';
import { Head } from '@inertiajs/vue3';
import {
  UserGroupIcon,
  CurrencyDollarIcon,
  ShoppingCartIcon,
  ChartBarIcon,
} from '@heroicons/vue/24/solid';

Chart.register(...registerables);

const stats = ref([
  { name: 'Total Users', value: '12,345', icon: UserGroupIcon, color: 'bg-blue-500' },
  { name: 'Revenue', value: '$678,910', icon: CurrencyDollarIcon, color: 'bg-green-500' },
  { name: 'New Orders', value: '234', icon: ShoppingCartIcon, color: 'bg-yellow-500' },
  { name: 'Conversion Rate', value: '4.5%', icon: ChartBarIcon, color: 'bg-purple-500' },
]);

const recentActivities = ref([
  { user: 'John Doe', action: 'created a new post', time: '2 hours ago' },
  { user: 'Jane Smith', action: 'updated their profile', time: '4 hours ago' },
  { user: 'Mike Johnson', action: 'made a purchase', time: '1 day ago' },
]);

const salesChart = ref(null);
const userChart = ref(null);

onMounted(() => {
  const salesCtx = document.getElementById('salesChart');
  salesChart.value = new Chart(salesCtx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Sales',
        data: [3000, 4500, 3500, 5000, 4800, 6000],
        borderColor: 'rgb(59, 130, 246)',
        tension: 0.3,
        fill: false,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        },
      },
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    }
  });

  const userCtx = document.getElementById('userChart');
  userChart.value = new Chart(userCtx, {
    type: 'doughnut',
    data: {
      labels: ['New', 'Returning', 'Inactive'],
      datasets: [{
        data: [300, 500, 200],
        backgroundColor: [
          'rgb(59, 130, 246)',
          'rgb(16, 185, 129)',
          'rgb(249, 115, 22)',
        ],
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          position: 'bottom',
        },
      },
    }
  });
});
</script>

<template>
  <Head title="Dashboard" />
  
  <div class="p-6 bg-gray-100 min-h-screen">
    <h1 class="text-3xl font-bold mb-8 text-gray-800">Dashboard</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div v-for="item in stats" :key="item.name" class="bg-white rounded-lg shadow-md p-6 flex items-center">
        <div :class="[item.color, 'p-3 rounded-full']">
          <component :is="item.icon" class="h-8 w-8 text-white" />
        </div>
        <div class="ml-4">
          <h2 class="text-lg font-semibold text-gray-700">{{ item.name }}</h2>
          <p class="text-2xl font-bold text-gray-900">{{ item.value }}</p>
        </div>
      </div>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">Sales Overview</h2>
        <div class="h-64">
          <canvas id="salesChart"></canvas>
        </div>
      </div>
      <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-semibold mb-4 text-gray-800">User Distribution</h2>
        <div class="h-64">
          <canvas id="userChart"></canvas>
        </div>
      </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6">
      <h2 class="text-xl font-semibold mb-4 text-gray-800">Recent Activities</h2>
      <ul class="divide-y divide-gray-200">
        <li v-for="activity in recentActivities" :key="activity.time" class="py-3">
          <p class="text-sm font-medium text-gray-900">{{ activity.user }} {{ activity.action }}</p>
          <p class="text-sm text-gray-500">{{ activity.time }}</p>
        </li>
      </ul>
    </div>
  </div>
</template>

<style scoped>
/* Add any component-specific styles here */
</style>

