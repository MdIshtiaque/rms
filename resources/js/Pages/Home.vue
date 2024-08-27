<script setup>
// Reactive state to track the active link
import {ref} from 'vue';

const activeLink = ref('Home'); // Default active link

// Function to set the active link
const setActiveLink = (link) => {
    activeLink.value = link;
};
</script>

<template>
    <div class="w-full h-16 bg-purple-800 flex justify-between shadow-2xl items-center px-6">
        <!-- Logo -->
        <div class="text-white text-2xl font-bold">
            Logo
        </div>

        <!-- Navigation Links Container for Centering -->
        <div class="flex-1 flex justify-center">
            <!-- Navigation Links -->
            <div class="hidden md:flex space-x-5 self-center">
                <a
                    href="#"
                    class="text-white hover:text-gray-200 px-4 py-2 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                    :class="{ active: activeLink === 'Home' }"
                    @click="setActiveLink('Home')"
                >
                    Home
                </a>
                <a
                    href="#"
                    class="text-white hover:text-gray-200 px-4 py-2 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                    :class="{ active: activeLink === 'About' }"
                    @click="setActiveLink('About')"
                >
                    About
                </a>
                <a
                    href="#"
                    class="text-white hover:text-gray-200 px-4 py-2 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                    :class="{ active: activeLink === 'Services' }"
                    @click="setActiveLink('Services')"
                >
                    Services
                </a>
                <a
                    href="#"
                    class="text-white hover:text-gray-200 px-4 py-2 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                    :class="{ active: activeLink === 'Contact' }"
                    @click="setActiveLink('Contact')"
                >
                    Contact
                </a>
            </div>
        </div>
        <div class="text-white flex gap-1">
            <a
                @click="setActiveLink('Sign in')"
                :class="{ active: activeLink === 'Sign in' }"
                class="cursor-pointer px-4 py-2 shadow-2xl font-bold bg-gray-500 rounded-[25px_10px_25px] transition-transform duration-150 ease-in-out transform active:scale-95 active:shadow-none">
                Sign in
            </a>
            <a
                @click="setActiveLink('Sign up')"
                :class="{ active: activeLink === 'Sign up' }"
                class="cursor-pointer px-4 py-2 shadow-2xl font-bold bg-amber-500 rounded-[25px_10px_25px] transition-transform duration-150 ease-in-out transform active:scale-95 active:shadow-none">
                Sign up
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button class="text-white focus:outline-none">
                <!-- Icon: Hamburger Menu -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
</template>

<style scoped>
.active,
.active-hover:hover {
    border-radius: 25px 10px 25px;
    background-color: #5fdb21;
    transition: background-color 0.3s ease, border-radius 0.3s ease;
}
</style>
