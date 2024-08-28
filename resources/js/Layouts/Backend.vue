<script setup>
import { ref } from 'vue';
import { ChevronRightIcon } from '@heroicons/vue/24/solid';
import { ChevronLeftIcon } from "@heroicons/vue/24/solid";

const isSidebarVisible = ref(true);

const toggleSidebar = () => {
    isSidebarVisible.value = !isSidebarVisible.value;
};
</script>

<template>
    <div class="flex w-full h-screen">
        <!-- Sidebar -->
            <div :class="isSidebarVisible ? 'w-[15%]' : 'w-0'" class="h-full bg-blue-950 transition-width duration-1000 ease overflow-hidden">
                <!-- Sidebar content here -->
            </div>

        <!-- Main content area -->
        <div :class="isSidebarVisible ? 'w-[85%]' : 'w-full'" class="h-full transition-width duration-1000 ease">
            <div class="w-full h-16 bg-indigo-600 flex justify-between items-center p-5">
                <!-- Toggle Button -->
                <button @click="toggleSidebar" class="text-white focus:outline-none">
                    <ChevronRightIcon v-if="!isSidebarVisible" class="h-6 w-6" />
                    <ChevronLeftIcon v-else class="h-6 w-6" />
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
