<script setup>
import { ref } from 'vue';
import { Bars3BottomRightIcon, ArrowRightStartOnRectangleIcon, Bars3Icon } from "@heroicons/vue/24/solid";
import Bubble from "../Components/Bubble.vue";

const isSidebarVisible = ref(true);
const activeMenu = ref('home'); // Default active menu

const toggleSidebar = () => {
    isSidebarVisible.value = !isSidebarVisible.value;
};

const setActiveMenu = (menu) => {
    activeMenu.value = menu;
};
</script>

<template>
    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        <div :class="isSidebarVisible ? 'w-[15%]' : 'w-0'"
             class="h-full primary-gradient-color transition-width duration-1000 ease overflow-hidden">
            <div class="flex justify-center w-full">
                <img src="../../../public/assets/logo3.png" class="h-44 w-44" alt="" srcset="">
            </div>
            <hr class="w-full border-b-1">

            <!-- Menu -->
            <nav class="mt-5">
                <ul>
                    <li @click="setActiveMenu('home')" :class="activeMenu.value === 'dashboard' ? 'bg-blue-500' : ''"
                        class="p-4 cursor-pointer hover:bg-blue-400">
                        Dashboard
                    </li>
                    <li @click="setActiveMenu('profile')" :class="activeMenu.value === 'profile' ? 'bg-blue-500' : ''"
                        class="p-4 cursor-pointer hover:bg-blue-400">
                        Profile
                    </li>
                    <li @click="setActiveMenu('settings')" :class="activeMenu.value === 'settings' ? 'bg-blue-500' : ''"
                        class="p-4 cursor-pointer hover:bg-blue-400">
                        Settings
                    </li>
                    <li @click="setActiveMenu('logout')" :class="activeMenu.value === 'logout' ? 'bg-blue-500' : ''"
                        class="p-4 cursor-pointer hover:bg-blue-400">
                        Logout
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div :class="isSidebarVisible ? 'w-[85%]' : 'w-full'" class="h-full transition-width duration-1000 ease">
            <div class="w-full h-16 primary-color flex justify-between items-center p-5">
                <button @click="toggleSidebar" class="text-white focus:outline-none">
                    <Bars3Icon v-if="!isSidebarVisible" class="h-6 w-6"/>
                    <Bars3BottomRightIcon v-else class="h-6 w-6"/>
                </button>
                <button class="flex gap-2 text-white focus:outline-none">
                    <ArrowRightStartOnRectangleIcon class="h-6 w-6"></ArrowRightStartOnRectangleIcon>
                    Logout
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Add any additional scoped styles here */
</style>
