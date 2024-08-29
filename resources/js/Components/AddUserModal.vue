<script setup>
import { ref } from 'vue';
import { XMarkIcon, UserCircleIcon } from '@heroicons/vue/24/outline';
import { useForm } from "@inertiajs/vue3";
import { useToast } from 'vue-toastification';

const props = defineProps({
  isOpen: Boolean,
});

const emit = defineEmits(['close', 'userAdded']);

const toast = useToast();

const form = useForm({
  name: null,
  email: null,
  role: null,
  password: null,
  password_confirmation: null,
  profileImage: null,
});

const roles = ['admin', 'user'];

const profileImagePreview = ref(null);

const handleImageUpload = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.profileImage = file;
        profileImagePreview.value = URL.createObjectURL(file);
    }
};

const submit = () => {
    form.post('/admin/user/store', {
        preserveScroll: true,
        onSuccess: () => {
            toast.success('User created successfully');
            emit('userAdded');
            emit('close');
            resetForm();
        },
        onError: () => form.reset('password', 'password_confirmation')
    });
};

const resetForm = () => {
    form.reset();
    profileImagePreview.value = null;
};
</script>

<template>
  <div v-if="isOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
      <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-75" aria-hidden="true" @click="emit('close')"></div>

      <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

      <div class="inline-block w-full overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
        <div class="absolute top-0 right-0 pt-4 pr-4">
          <button type="button" @click="emit('close')" class="text-gray-400 bg-white rounded-md hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            <span class="sr-only">Close</span>
            <XMarkIcon class="w-6 h-6" aria-hidden="true" />
          </button>
        </div>
        <form @submit.prevent="submit">
          <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
            <div class="sm:flex sm:items-start">
              <div class="w-full mt-3 text-center sm:mt-0 sm:text-left">
                <h3 class="text-lg font-medium leading-6 text-gray-900" id="modal-title">
                  Add New User
                </h3>
                <div class="mt-2">
                  <div class="space-y-4">
                    <div class="flex items-center sm:justify-start md:justify-center">
                      <div class="relative w-24 h-24 overflow-hidden bg-gray-100 rounded-full">
                        <img v-if="profileImagePreview" :src="profileImagePreview" class="object-cover w-full h-full" alt="Profile preview" />
                        <UserCircleIcon v-else class="w-full h-full text-gray-300" />
                        <label for="profile-image" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 cursor-pointer opacity-0 hover:opacity-100">
                          <span class="text-sm font-medium text-white">Change</span>
                        </label>
                        <input id="profile-image" type="file" accept="image/*" @change="handleImageUpload" class="hidden" />
                        <small class="error" v-if="form.errors.profileImage">{{ form.errors.profileImage }}</small>
                      </div>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                      <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                        <input type="text" id="name" v-model="form.name" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <small class="error" v-if="form.errors.name">{{ form.errors.name }}</small>
                      </div>
                      <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="email" v-model="form.email" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <small class="error" v-if="form.errors.email">{{ form.errors.email }}</small>
                      </div>
                    </div>
                    <div>
                      <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                      <select id="role" v-model="form.role" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="" disabled>Select a role</option>
                        <option v-for="role in roles" :key="role" :value="role">{{ role }}</option>
                    </select>
                    <small class="error" v-if="form.errors.role">{{ form.errors.role }}</small>
                    </div>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                      <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="password" v-model="form.password" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <small class="error" v-if="form.errors.password">{{ form.errors.password }}</small>
                      </div>
                      <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input type="password" id="password_confirmation" v-model="form.password_confirmation" required class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
            <button type="submit" :disabled="form.processing" class="inline-flex justify-center w-full px-4 py-2 text-base font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
              Add User
            </button>
            <button type="button" @click="emit('close')" class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
              Cancel
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
