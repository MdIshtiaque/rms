<script setup>
import { MagnifyingGlassIcon, PencilIcon, PlusIcon, TrashIcon } from '@heroicons/vue/24/outline';
import { router } from "@inertiajs/vue3";
import debounce from 'lodash/debounce';
import { onMounted, onUnmounted, ref, watch } from 'vue';
import { useToast } from 'vue-toastification';
import AddUserModal from '../../Components/AddUserModal.vue';
import Pagination from '../../Components/Pagination.vue';
import Backend from "../../Layouts/Backend.vue";
import EditUserModal from '../../Components/EditUserModal.vue';
import ConfirmDeleteModal from '../../Components/ConfirmDeleteModal.vue';

defineOptions({ layout: Backend })

const toast = useToast();

const props = defineProps({
  users: Object,
  filters: Object,
  availableRoles: Array,
});

const users = ref(props.users);
const searchQuery = ref(props.filters.search);

const search = debounce(() => {
  router.get('/admin/users', { search: searchQuery.value }, {
    preserveState: true,
    replace: true,
  });
}, 300);

watch(searchQuery, search);

const isAddUserModalOpen = ref(false);
const isEditUserModalOpen = ref(false);
const selectedUser = ref(null);

const openAddUserModal = () => {
  isAddUserModalOpen.value = true;
};

const closeAddUserModal = () => {
  isAddUserModalOpen.value = false;
};

const openEditUserModal = (user) => {
  selectedUser.value = user;
  isEditUserModalOpen.value = true;
};

const closeEditUserModal = () => {
  isEditUserModalOpen.value = false;
  selectedUser.value = null;
};

const handleUserAdded = () => {
  router.visit('/admin/users', { only: ['users'] });
};

const handleUserUpdated = () => {
  router.visit('/admin/users', { only: ['users'] });
};

const deleteUser = (userId) => {
  if (confirm('Are you sure you want to delete this user?')) {
    router.delete(`/admin/user/${userId}/delete`, {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        toast.success('User deleted successfully');
        router.visit('/admin/users', { only: ['users'] });
      },
      onError: (errors) => {
        toast.error('Failed to delete user');
        console.error(errors);
      },
    });
  }
};

const tableHeight = ref('calc(100vh - 300px)');

const updateTableHeight = () => {
  const headerHeight = document.querySelector('header')?.offsetHeight || 0;
  const titleSectionHeight = document.querySelector('.title-section')?.offsetHeight || 0;
  const searchHeight = document.querySelector('.search-input')?.offsetHeight || 0;
  const paginationHeight = document.querySelector('.pagination')?.offsetHeight || 0;
  const offset = headerHeight + titleSectionHeight + searchHeight + paginationHeight + 40; // Reduced padding
  tableHeight.value = `calc(100vh - ${offset}px)`;
};

onMounted(() => {
  updateTableHeight();
  window.addEventListener('resize', updateTableHeight);
});

onUnmounted(() => {
  window.removeEventListener('resize', updateTableHeight);
});

const isDeleteModalOpen = ref(false);
const userToDelete = ref(null);

const openDeleteModal = (user) => {
  userToDelete.value = user;
  isDeleteModalOpen.value = true;
};

const closeDeleteModal = () => {
  isDeleteModalOpen.value = false;
  userToDelete.value = null;
};

const confirmDelete = () => {
  if (userToDelete.value) {
    router.delete(`/admin/user/${userToDelete.value.id}/delete`, {
      preserveState: true,
      preserveScroll: true,
      onSuccess: () => {
        toast.success('User deleted successfully');
        closeDeleteModal();
        handleUserAdded();
      },
      onError: () => {
        toast.error('Failed to delete user');
        closeDeleteModal();
      },
    });
  }
};
</script>

<template>
  <Head title="| Users" />
  <div class="px-4 py-4 bg-gray-100 h-full flex flex-col">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-4 title-section">
      <div class="mb-4 md:mb-0">
        <h1 class="text-2xl font-bold text-gray-900">Users</h1>
        <p class="mt-1 text-sm text-gray-600">Manage your user accounts</p>
      </div>
      <button
        @click="openAddUserModal"
        class="inline-flex items-center justify-center w-full md:w-auto px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:border-indigo-900 focus:ring focus:ring-indigo-300 disabled:opacity-25 transition"
      >
        <PlusIcon class="h-5 w-5 mr-2" />
        Add User
      </button>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-hidden flex-grow flex flex-col">
      <div class="p-4 flex-grow flex flex-col">
        <div class="relative w-full max-w-md mb-4 search-input">
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Search users..."
            class="w-full pl-10 pr-4 py-2 text-gray-700 bg-gray-100 border border-gray-300 rounded-full focus:outline-none focus:border-indigo-500 focus:bg-white transition-colors duration-200 ease-in-out"
          >
          <MagnifyingGlassIcon class="h-5 w-5 text-gray-500 absolute left-3 top-1/2 transform -translate-y-1/2" />
        </div>

        <div class="flex-grow flex flex-col overflow-hidden">
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th scope="col" class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-2/5 sm:w-1/3 md:w-1/4">Name</th>
                  <th scope="col" class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/5 hidden sm:table-cell">Email</th>
                  <th scope="col" class="px-6 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-1/5 hidden md:table-cell">Role</th>
                  <th scope="col" class="px-6 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider w-1/5 sm:w-1/4 md:w-1/5">Actions</th>
                </tr>
              </thead>
            </table>
          </div>
          <div class="overflow-y-auto flex-grow" :style="{ maxHeight: tableHeight }">
            <table class="min-w-full divide-y divide-gray-200">
              <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="user in users.data" :key="user.id" class="hover:bg-gray-50">
                  <td class="px-6 py-2 whitespace-nowrap w-2/5 sm:w-1/3 md:w-1/4">
                    <div class="flex items-center">
                      <div class="flex-shrink-0 h-10 w-10">
                        <img class="h-10 w-10 rounded-full" :src="user.profileImage ? `/storage/${user.profileImage}` : `https://ui-avatars.com/api/?name=${user.name}&background=random`" :alt="user.name" />
                      </div>
                      <div class="ml-4">
                        <div class="text-sm font-medium text-gray-900">{{ user.name }}</div>
                        <div class="text-sm text-gray-500 sm:hidden">{{ user.email }}</div>
                        <div class="text-sm text-gray-500 sm:hidden md:hidden">{{ user.role }}</div>
                      </div>
                    </div>
                  </td>
                  <td class="px-6 py-2 whitespace-nowrap w-1/5 hidden sm:table-cell">
                    <div class="text-sm text-gray-900">{{ user.email }}</div>
                  </td>
                  <td class="px-6 py-2 whitespace-nowrap w-1/5 hidden md:table-cell">
                    <div class="text-sm text-gray-900">{{ user.role }}</div>
                  </td>
                  <td class="px-6 py-2 whitespace-nowrap text-right text-sm font-medium w-1/5 sm:w-1/4 md:w-1/5">
                    <button @click="openEditUserModal(user)" class="text-indigo-600 hover:text-indigo-900 mr-2">
                      <PencilIcon class="h-5 w-5 inline" />
                    </button>
                    <button @click="openDeleteModal(user)" class="text-red-600 hover:text-red-900">
                      <TrashIcon class="h-5 w-5 inline" />
                    </button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <div class="mt-4 pagination">
      <Pagination :links="users" />
    </div>
  </div>
  <AddUserModal
    :is-open="isAddUserModalOpen"
    :available-roles="availableRoles"
    @close="closeAddUserModal"
    @user-added="handleUserAdded"
  />
  <EditUserModal
    :is-open="isEditUserModalOpen"
    :available-roles="availableRoles"
    :user="selectedUser"
    @close="closeEditUserModal"
    @user-updated="handleUserUpdated"
  />
  <ConfirmDeleteModal
    :is-open="isDeleteModalOpen"
    title="Delete User"
    :message="`Are you sure you want to delete ${userToDelete?.name}? This action cannot be undone.`"
    @close="closeDeleteModal"
    @confirm="confirmDelete"
    @user-added="handleUserAdded"
  />
</template>

