<script setup>
import { ref } from 'vue';
import { Link } from "@inertiajs/vue3";

const activeLink = ref('Home'); // Default active link

// Function to set the active link
const setActiveLink = (link) => {
    activeLink.value = link;
};

// Reactive state to track the mobile menu visibility
const isMobileMenuOpen = ref(false);

// Function to toggle the mobile menu
const toggleMobileMenu = () => {
    isMobileMenuOpen.value = !isMobileMenuOpen.value;
};
</script>

<template>
    <div class="w-full h-16 nav flex justify-between shadow-2xl items-center px-6">
        <!-- Logo -->
        <div class="text-white text-2xl font-bold">
            <img src="../../../public/assets/logo.png" alt="Logo" class="h-24" />
        </div>

        <!-- Navigation Links Container for Centering -->
        <div class="hidden md:flex flex-1 justify-center">
            <!-- Navigation Links -->
            <div class="space-x-5 self-center">
                <Link
                    href="/"
                    class="text-white hover:text-gray-200 px-4 py-2 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                    :class="{ active: $page.component === 'Home' }"
                    @click="setActiveLink('Home')"
                >
                    Home
                </Link>
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

        <!-- Sign in/Sign up buttons -->
        <div class="hidden md:flex text-white gap-1">
            <Link
                href="/login"
                @click="setActiveLink('Sign in')"
                class="cursor-pointer px-4 py-2 shadow-2xl font-bold bg-blue-950 rounded-[25px_10px_25px] transition-colors duration-300 ease-in-out transform hover:bg-indigo-600 active:scale-95 active:shadow-none"
            >
                Sign in
            </Link>
            <a
                @click="setActiveLink('Sign up')"
                class="cursor-pointer px-4 py-2 shadow-2xl font-bold bg-blue-950 rounded-[25px_10px_25px] transition-colors duration-300 ease-in-out transform hover:bg-indigo-600 active:scale-95 active:shadow-none"
            >
                Sign up
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button @click="toggleMobileMenu" class="text-white focus:outline-none">
                <!-- Icon: Hamburger Menu -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu with Transition -->
    <transition
        enter-active-class="transition ease-out duration-300 transform"
        enter-from-class="opacity-0 -translate-y-4"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition ease-in duration-300 transform"
        leave-from-class="opacity-100 translate-y-0"
        leave-to-class="opacity-0 -translate-y-4"
    >
        <div v-if="isMobileMenuOpen" class="md:hidden bg-gradient-to-r from-indigo-600 to-blue-500 p-4 space-y-3">
            <Link
                href="/"
                class="block text-white hover:text-gray-200 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                :class="{ active: $page.component === 'Home' }"
                @click="setActiveLink('Home'); toggleMobileMenu()"
            >
                Home
            </Link>
            <a
                href="#"
                class="block text-white hover:text-gray-200 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                :class="{ active: activeLink === 'About' }"
                @click="setActiveLink('About'); toggleMobileMenu()"
            >
                About
            </a>
            <a
                href="#"
                class="block text-white hover:text-gray-200 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                :class="{ active: activeLink === 'Services' }"
                @click="setActiveLink('Services'); toggleMobileMenu()"
            >
                Services
            </a>
            <a
                href="#"
                class="block text-white hover:text-gray-200 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                :class="{ active: activeLink === 'Contact' }"
                @click="setActiveLink('Contact'); toggleMobileMenu()"
            >
                Contact
            </a>
            <div class="flex gap-1">
                <Link
                    href="/login"
                    @click="setActiveLink('Sign in'); toggleMobileMenu()"
                    class="text-slate-50 text-center w-full cursor-pointer px-4 py-2 shadow-2xl font-bold bg-blue-950 rounded-[25px_10px_25px] transition-colors duration-300 ease-in-out transform hover:bg-indigo-600 active:scale-95 active:shadow-none"
                >
                    Sign in
                </Link>
                <a
                    @click="setActiveLink('Sign up'); toggleMobileMenu()"
                    class="text-slate-50 text-center w-full cursor-pointer px-4 py-2 shadow-2xl font-bold bg-blue-950 rounded-[25px_10px_25px] transition-colors duration-300 ease-in-out transform hover:bg-indigo-600 active:scale-95 active:shadow-none"
                >
                    Sign up
                </a>
            </div>
        </div>
    </transition>

    <!-- Slot for other content -->
    <slot />
</template>

<style scoped>
.active,
.active-hover:hover {
    border-radius: 25px 10px 25px;
    background-color: #4f46e5; /* Tailwind's indigo-600 */
    transition: background-color 0.3s ease, border-radius 0.3s ease;
}

.nav {
    background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
}
</style>
