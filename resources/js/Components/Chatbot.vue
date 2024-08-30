<script setup>
import { ref } from 'vue';
import { XMarkIcon } from '@heroicons/vue/24/solid';
import { useForm } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  // Add any props if needed
});

const emit = defineEmits(['close']);

const messages = ref([]);
const form = useForm({
  message: '',
});

const sendMessage = () => {
  if (form.message.trim()) {
    messages.value.push({ text: form.message, isUser: true });
    router.post('/chat', form, {
      preserveState: true,
      preserveScroll: true,
      onSuccess: (page) => {
        // Check if the flash message exists in the Inertia page props
        const flashMessage = page.props.flash?.message || page.props.flash?.error;
        if (flashMessage) {
          messages.value.push({ text: flashMessage, isUser: false });
        } else {
          messages.value.push({ text: "Sorry, I couldn't process your request.", isUser: false });
        }
        form.reset('message');
      },
      onError: (errors) => {
        console.error(errors);
        messages.value.push({ text: "An error occurred while processing your request.", isUser: false });
      }
    });
  }
};
</script>

<template>
  <div class="fixed bottom-16 right-4 w-80 bg-white rounded-lg shadow-xl overflow-hidden">
    <div class="bg-blue-600 text-white p-4 flex justify-between items-center">
      <h3 class="text-lg font-semibold">Chat Support</h3>
      <button @click="$emit('close')" class="text-white hover:text-gray-200">
        <XMarkIcon class="h-6 w-6" />
      </button>
    </div>
    <div class="h-80 overflow-y-auto p-4">
      <div v-for="(message, index) in messages" :key="index" class="mb-4">
        <div :class="[
          'max-w-3/4 rounded-lg p-2',
          message.isUser ? 'bg-blue-100 ml-auto' : 'bg-gray-100'
        ]">
          {{ message.text }}
        </div>
      </div>
    </div>
    <div class="border-t p-4">
      <form @submit.prevent="sendMessage" class="flex">
        <input
          v-model="form.message"
          type="text"
          placeholder="Type your message..."
          class="flex-grow px-3 py-2 border rounded-l-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
        <button
          type="submit"
          :disabled="form.processing"
          class="bg-blue-600 text-white px-4 py-2 rounded-r-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
        >
          Send
        </button>
      </form>
    </div>
  </div>
</template>
