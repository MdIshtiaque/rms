<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from "@inertiajs/vue3";

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

// Add this computed property to check if we're on the login page
const isLoginPage = computed(() => usePage().url === '/login');
</script>

<template>
    <div class="flex flex-col min-h-screen">
        <header class="sticky top-0 left-0 z-50">
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
                        <Link
                            href="/about"
                            class="text-white hover:text-gray-200 px-4 py-2 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                            :class="{ active: $page.component === 'About' }"
                            @click="setActiveLink('About')"
                        >
                            About
                        </Link>
                        <Link
                            href="/services"
                            class="text-white hover:text-gray-200 px-4 py-2 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                            :class="{ active: $page.component === 'Services' }"
                            @click="setActiveLink('Services')"
                        >
                            Services
                        </Link>
                        <Link
                            href="/contact"
                            class="text-white hover:text-gray-200 px-4 py-2 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                            :class="{ active: $page.component === 'Contact' }"
                            @click="setActiveLink('Contact')"
                        >
                            Contact
                        </Link>
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
                    <Link
                        @click="setActiveLink('Sign up')"
                        class="cursor-pointer px-4 py-2 shadow-2xl font-bold bg-blue-950 rounded-[25px_10px_25px] transition-colors duration-300 ease-in-out transform hover:bg-indigo-600 active:scale-95 active:shadow-none"
                    >
                        Sign up
                    </Link>
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
        </header>

        <main class="flex-grow">
            <!-- Slot for other content -->
            <slot />
        </main>

        <!-- Conditionally render the footer -->
        <footer v-if="!isLoginPage" class="bg-gradient-to-r from-blue-50 to-indigo-100 text-gray-700 py-16">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="space-y-4">
                        <img src="../../../public/assets/logo.png" alt="Logo" class="h-20" />
                        <p class="text-gray-600">Simplifying living expenses for bachelors and renters.</p>
                        <div class="flex space-x-4">
                            <Link href="#" class="text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                            </Link>
                            <Link href="#" class="text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd" /></svg>
                            </Link>
                            <Link href="#" class="text-blue-600 hover:text-blue-800 transition-colors duration-300">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                            </Link>
                        </div>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-indigo-700">Quick Links</h3>
                        <ul class="space-y-2">
                            <li><Link href="/" class="text-gray-600 hover:text-indigo-700 transition-colors duration-300">Home</Link></li>
                            <li><Link href="#" class="text-gray-600 hover:text-indigo-700 transition-colors duration-300">About</Link></li>
                            <li><Link href="#" class="text-gray-600 hover:text-indigo-700 transition-colors duration-300">Services</Link></li>
                            <li><Link href="#" class="text-gray-600 hover:text-indigo-700 transition-colors duration-300">Contact</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-indigo-700">Resources</h3>
                        <ul class="space-y-2">
                            <li><Link href="#" class="text-gray-600 hover:text-indigo-700 transition-colors duration-300">Blog</Link></li>
                            <li><Link href="#" class="text-gray-600 hover:text-indigo-700 transition-colors duration-300">FAQ</Link></li>
                            <li><Link href="#" class="text-gray-600 hover:text-indigo-700 transition-colors duration-300">Support</Link></li>
                            <li><Link href="#" class="text-gray-600 hover:text-indigo-700 transition-colors duration-300">Privacy Policy</Link></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4 text-indigo-700">Newsletter</h3>
                        <p class="text-gray-600 mb-4">Stay updated with our latest features and news.</p>
                        <form class="flex">
                            <input type="email" placeholder="Enter your email" class="bg-white text-gray-800 px-4 py-2 rounded-l-md focus:outline-none focus:ring-2 focus:ring-indigo-500 flex-grow" />
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-md hover:bg-indigo-700 transition-colors duration-300">Subscribe</button>
                        </form>
                    </div>
                </div>
                <div class="border-t border-gray-200 mt-12 pt-8 text-center text-gray-600">
                    <p>&copy; 2023 RMS. All rights reserved.</p>
                </div>
            </div>
        </footer>
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
            <Link
                href="#"
                class="block text-white hover:text-gray-200 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                :class="{ active: activeLink === 'About' }"
                @click="setActiveLink('About'); toggleMobileMenu()"
            >
                About
            </Link>
            <Link
                href="#"
                class="block text-white hover:text-gray-200 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                :class="{ active: activeLink === 'Services' }"
                @click="setActiveLink('Services'); toggleMobileMenu()"
            >
                Services
            </Link>
            <Link
                href="#"
                class="block text-white hover:text-gray-200 transition-all duration-300 ease-in-out rounded-[25px_10px_25px] active-hover"
                :class="{ active: activeLink === 'Contact' }"
                @click="setActiveLink('Contact'); toggleMobileMenu()"
            >
                Contact
            </Link>
            <div class="flex gap-1">
                <Link
                    href="/login"
                    @click="setActiveLink('Sign in'); toggleMobileMenu()"
                    class="text-slate-50 text-center w-full cursor-pointer px-4 py-2 shadow-2xl font-bold bg-blue-950 rounded-[25px_10px_25px] transition-colors duration-300 ease-in-out transform hover:bg-indigo-600 active:scale-95 active:shadow-none"
                >
                    Sign in
                </Link>
                <Link
                    @click="setActiveLink('Sign up'); toggleMobileMenu()"
                    class="text-slate-50 text-center w-full cursor-pointer px-4 py-2 shadow-2xl font-bold bg-blue-950 rounded-[25px_10px_25px] transition-colors duration-300 ease-in-out transform hover:bg-indigo-600 active:scale-95 active:shadow-none"
                >
                    Sign up
                </Link>
            </div>
        </div>
    </transition>
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
