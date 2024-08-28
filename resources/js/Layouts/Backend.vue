<script setup>
import {ref} from 'vue';
import {
    ArrowLeftStartOnRectangleIcon,
    Bars3BottomRightIcon,
    Bars3Icon,
    CogIcon,
    HomeIcon,
    UserCircleIcon
} from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";

const isSidebarVisible = ref(true); // Ensure the sidebar is visible by default on desktop
const activeLink = ref('Home'); // Default active link

const toggleSidebar = () => {
    isSidebarVisible.value = !isSidebarVisible.value;
};

const setActiveLink = (link) => {
    activeLink.value = link;
    if (window.innerWidth <= 768) {
        isSidebarVisible.value = false;
    }
};

</script>

<template>
    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        <div
            :class="`sidebar transition-width duration-700 ease-out overflow-hidden ${isSidebarVisible ? 'w-[100%] sm:w-[15%]' : 'w-0'} h-full text-white shadow-lg`">
            <div class="flex flex-col items-center w-full p-4">
                <img src="../../../public/assets/logo3.png" class="h-24 w-24 mb-4 rounded-full border-2 border-gray-700"
                     alt="Logo">
                <hr class="w-full border-gray-600">
            </div>
            <nav class="mt-5 px-2">
                <ul class="space-y-2">
                    <li
                        class="flex items-center active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ 'active': activeLink === 'Home' }"
                        @click="setActiveLink('Home')">
                        <HomeIcon class="h-5 w-5 mr-3"/>
                        Home
                    </li>
                    <li
                        class="flex items-center active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ 'active': activeLink === 'Profile' }"
                        @click="setActiveLink('Profile')">
                        <UserCircleIcon class="h-5 w-5 mr-3"/>
                        Profile
                    </li>
                    <li
                        class="flex items-center active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ 'active': activeLink === 'Settings' }"
                        @click="setActiveLink('Settings')">
                        <CogIcon class="h-5 w-5 mr-3"/>
                        Settings
                    </li>
                    <li
                        class="flex items-center active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ 'active': activeLink === 'Logout' }"
                        @click="setActiveLink('Logout')">
                        <ArrowLeftStartOnRectangleIcon class="h-5 w-5 mr-3"/>
                        Logout
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div
            :class="`transition-width duration-300 ease-in-out ${isSidebarVisible && !isSidebarVisible ? 'w-[100%] sm:w-[85%]' : 'w-full'}`">
            <div
                class="top-bar w-full h-16 bg-gradient-to-r from-blue-500 to-blue-700 text-white flex justify-between items-center p-5 shadow-md">
                <button @click="toggleSidebar" class="focus:outline-none" aria-label="Toggle Sidebar">
                    <Bars3Icon v-if="!isSidebarVisible" class="h-6 w-6"/>
                    <Bars3BottomRightIcon v-else class="h-6 w-6"/>
                </button>
                <Link href="#"
                      class="flex gap-2 focus:outline-none header font-bold cursor-pointer shadow-2xl transition-colors duration-300 ease-in-out transform hover:text-indigo-600 active:scale-95 active:shadow-none"
                      aria-label="Logout"
                >
                    <ArrowLeftStartOnRectangleIcon class="h-6 w-6"/>
                    Logout
                </Link>
            </div>
            <!-- Additional content can go here -->
        </div>
    </div>
</template>

<style scoped>
.active, .active-hover:hover {
    background: linear-gradient(100deg, #02278c 0%, #02278c 100%);
    border-radius: 45px 10px 45px;
}

.sidebar {
    background: linear-gradient(0deg, #4e54c8 0%, #8f94fb 100%);
}

.top-bar {
    background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
}
</style>
