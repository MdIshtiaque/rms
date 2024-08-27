<script setup>
import { ref } from 'vue';
import { XMarkIcon } from '@heroicons/vue/24/solid';

const isSidebarVisible = ref(true);

const toggleSidebar = () => {
    isSidebarVisible.value = !isSidebarVisible.value;
};
</script>

<template>
    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        <transition name="slide">
            <div v-if="isSidebarVisible" class="w-[15%] h-full bg-blue-950">
                <!-- Sidebar content here -->
            </div>
        </transition>

        <!-- Main content area -->
        <div :class="isSidebarVisible ? 'w-[85%]' : 'w-full'" class="h-full transition-all duration-300 ease-in-out">
            <div class="w-full h-16 bg-indigo-600 flex justify-between items-center p-5">
                <!-- Toggle Button -->
                <button @click="toggleSidebar" class="text-white focus:outline-none">
                    <MenuIcon v-if="!isSidebarVisible" class="h-6 w-6" />
                    <XMarkIcon v-else class="h-6 w-6" />
                </button>
                <!-- Other top bar content -->
            </div>
            <!-- Main content goes here -->
        </div>
    </div>
</template>

<style scoped>
/* Slide transition for the sidebar */
.slide-enter-active, .slide-leave-active {
    transition: all 0.3s ease;
}
.slide-enter, .slide-leave-to {
    transform: translateX(-100%);
}
</style>
