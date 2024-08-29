<script setup>
import Backend from "../../Layouts/Backend.vue";
import { PencilIcon, TrashIcon, PlusIcon, MagnifyingGlassIcon, ChevronLeftIcon, ChevronRightIcon } from '@heroicons/vue/24/outline';
import { ref } from 'vue';
import { Link } from "@inertiajs/vue3";
defineOptions({ layout: Backend })

const users = ref([
  { id: 1, name: 'Vera Carpenter', email: 'vera@example.com', role: 'Admin', status: 'Active' },
  { id: 2, name: 'Blake Bowman', email: 'blake@example.com', role: 'Editor', status: 'Active' },
  { id: 3, name: 'Blake Bowman', email: 'blake@example.com', role: 'Editor', status: 'Active' },
  { id: 4, name: 'Blake Bowman', email: 'blake@example.com', role: 'Editor', status: 'Active' },
  { id: 5, name: 'Blake Bowman', email: 'blake@example.com', role: 'Editor', status: 'Active' },
  { id: 6, name: 'Blake Bowman', email: 'blake@example.com', role: 'Editor', status: 'Active' },
  { id: 7, name: 'Blake Bowman', email: 'blake@example.com', role: 'Editor', status: 'Active' },
  { id: 8, name: 'Blake Bowman', email: 'blake@example.com', role: 'Editor', status: 'Active' },
  { id: 9, name: 'Blake Bowman', email: 'blake@example.com', role: 'Editor', status: 'Active' },
  { id: 10, name: 'Blake Bowman', email: 'blake@example.com', role: 'Editor', status: 'Active' },
  // Add more user objects as needed
]);

const searchQuery = ref('');
</script>

<template>
  <Head title="| Users" />
  <div class=" py-8 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
      <div class="mb-4 md:mb-0">
        <h1 class="text-3xl font-bold text-gray-900">Users</h1>
        <p class="mt-2 text-sm text-gray-600">Manage your user accounts</p>
      </div>
      <Link 
        href="#" 
        class="inline-flex items-center justify-center w-full md:w-auto px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition"
      >
        <PlusIcon class="h-5 w-5 mr-2" />
        Add User
      </Link>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <div class="p-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
          <div class="relative w-full max-w-md mb-4 sm:mb-0">
            <input
              v-model="searchQuery"
              type="text"
              placeholder="Search users..."
              class="w-full pl-12 pr-4 py-3 text-gray-700 bg-gray-100 border-2 border-gray-200 rounded-full focus:outline-none focus:border-indigo-500 focus:bg-white transition-colors duration-200 ease-in-out"
            >
            <button class="absolute inset-y-0 right-0 flex items-center pr-4 text-indigo-600 hover:text-indigo-800">
              <MagnifyingGlassIcon class="h-5 w-5 text-gray-500" />
            </button>
          </div>
        </div>

        <div class="mt-8 overflow-x-auto">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Actions</span>
                </th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10">
                      <img class="h-10 w-10 rounded-full" :src="`https://ui-avatars.com/api/?name=${user.name}&background=random`" :alt="user.name" />
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ user.email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ user.role }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{ user.status }}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                  <button class="text-indigo-600 hover:text-indigo-900 mr-2">
                    <PencilIcon class="h-5 w-5" />
                  </button>
                  <button class="text-red-600 hover:text-red-900">
                    <TrashIcon class="h-5 w-5" />
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <div class="mt-8">
      <!-- Mobile pagination (unchanged) -->
      <div class="flex justify-between items-center sm:hidden">
         <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
          <ChevronLeftIcon class="h-5 w-5 mr-2" />
          Previous
        </a>
        <p class="text-sm text-gray-700">
          Page <span class="font-medium">1</span> of <span class="font-medium">5</span>
        </p>
        <a href="#" class="inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
          Next
          <ChevronRightIcon class="h-5 w-5 ml-2" />
        </a>
      </div>

      <!-- Desktop pagination -->
      <div class="hidden sm:flex sm:items-center sm:justify-between">
        <div>
          <p class="text-sm text-gray-700">
            Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">50</span> results
          </p>
        </div>
        <div>
          <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
              <span class="sr-only">Previous</span>
              <ChevronLeftIcon class="h-5 w-5" />
            </a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
              1
            </a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
              2
            </a>
            <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
              3
            </a>
            <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
              <span class="sr-only">Next</span>
              <ChevronRightIcon class="h-5 w-5" />
            </a>
          </nav>
        </div>
      </div>
    </div>
  </div>
</template>