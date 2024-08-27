<script setup>

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
                <a href="#" class="text-white hover:text-gray-200 active">Home</a>
                <a href="#" class="text-white hover:text-gray-200 px-4 py-2">About</a>
                <a href="#" class="text-white hover:text-gray-200 px-4 py-2">Services</a>
                <a href="#" class="text-white hover:text-gray-200 px-4 py-2">Contact</a>
            </div>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button class="text-white focus:outline-none">
                <!-- Icon: Hamburger Menu -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>
    </div>
</template>

<style scoped>
.active {
    background-color: #5fdb21;
    border-radius: 25px 10px 25px;
    padding: 10px 18px 10px 18px;
    font-weight: bold;
}
</style>
