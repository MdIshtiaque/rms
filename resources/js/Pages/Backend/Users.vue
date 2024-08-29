<script setup>
import Backend from "../../Layouts/Backend.vue";
import { PencilIcon, TrashIcon, PlusIcon } from '@heroicons/vue/24/outline';
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
  <div class="container mx-auto py-10 px-4">
    <!-- Breadcrumb -->
    <nav class="text-sm mb-6" aria-label="Breadcrumb">
      <ol class="list-none p-0 inline-flex">
        <li class="flex items-center">
          <a href="#" class="text-gray-500 hover:text-gray-700">Home</a>
          <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"/></svg>
        </li>
        <li>
          <span class="text-gray-700 font-medium">Users</span>
        </li>
      </ol>
    </nav>

    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold">Users</h1>
      <Link href="#" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded flex items-center">
        <PlusIcon class="h-5 w-5 mr-2" />
        <span>Add User</span>
      </Link>
    </div>

    <!-- Search input -->
    <div class="mb-6">
      <input
        v-model="searchQuery"
        type="text"
        placeholder="Search users..."
        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
      >
    </div>

    <!-- Users Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full leading-normal">
        <thead>
          <tr>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Name
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Email
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Role
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Status
            </th>
            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
              Actions
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in users" :key="user.id" class="hover:bg-gray-50">
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <div class="flex items-center">
                <div class="flex-shrink-0 w-10 h-10">
                  <img class="w-full h-full rounded-full" :src="`https://ui-avatars.com/api/?name=${user.name}&background=random`" :alt="user.name" />
                </div>
                <div class="ml-3">
                  <p class="text-gray-900 whitespace-no-wrap">
                    {{ user.name }}
                  </p>
                </div>
              </div>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <p class="text-gray-900 whitespace-no-wrap">{{ user.email }}</p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <p class="text-gray-900 whitespace-no-wrap">{{ user.role }}</p>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <span class="relative inline-block px-3 py-1 font-semibold text-green-900 leading-tight">
                <span aria-hidden class="absolute inset-0 bg-green-200 opacity-50 rounded-full"></span>
                <span class="relative">{{ user.status }}</span>
              </span>
            </td>
            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
              <button class="text-blue-500 hover:text-blue-700 mr-2">
                <PencilIcon class="h-5 w-5" />
              </button>
              <button class="text-red-500 hover:text-red-700">
                <TrashIcon class="h-5 w-5" />
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
      <p class="text-sm text-gray-700">
        Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">50</span> results
      </p>
      <div class="flex-1 flex justify-end">
        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
          <a href="#" class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
            <span class="sr-only">Previous</span>
            <i class="fas fa-chevron-left"></i>
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
            <i class="fas fa-chevron-right"></i>
          </a>
        </nav>
      </div>
    </div>
  </div>
</template>