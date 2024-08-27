<script setup>
import Frontend from "../Layouts/Frontend.vue";
import { Link } from "@inertiajs/vue3";
import Bubble from "../Components/Bubble.vue";
defineOptions({ layout: Frontend });
</script>

<template>
    <div class="flex flex-col md:flex-row w-full h-screen">
        <!-- Left Side: Welcome Section -->
        <div class="relative flex flex-col justify-center items-start pl-[5%] w-full md:w-2/5 h-1/2 md:h-screen blank">
            <Bubble />
            <h1 class="text-5xl md:text-7xl font-bold text-slate-50">Welcome</h1>
            <h1 class="text-5xl md:text-7xl font-bold text-slate-50">To</h1>
            <h1 class="text-5xl md:text-7xl font-bold text-slate-50">RMS</h1>
            <p class="mt-4 md:mt-8 text-base md:text-lg text-slate-100 max-w-lg">
                RMS is a comprehensive system designed to streamline the management of all your living expenses. From handling flat rent and utilities to organizing meal costs, RMS simplifies every aspect of shared living, making it easier for bachelors and renters to stay on top of their finances.
            </p>
        </div>

        <!-- Right Side: Sign In Form -->
        <div class="flex flex-col w-full justify-center md:w-3/5 h-1/2 md:h-screen input-background">
            <h1 class="title text-center">Sign in to your account</h1>
            <div class="w-11/12 md:w-2/4 mt-8 md:mt-10 mx-auto">
                <form>
                    <div class="mb-6">
                        <label for="email">Email</label>
                        <input type="email" id="email" autocomplete="username" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-6">
                        <label for="password">Password</label>
                        <input type="password" id="password" autocomplete="current-password" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-6 text-center md:text-left">
                        <p class="text-slate-500 mb-2">Don't have an account?
                            <Link href="#" class="text-link">Register</Link>
                        </p>
                        <button class="primary-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style scoped>
.input-background {
    background: linear-gradient(90deg, #fdfbfb 0%, #ebedee 100%);
}
.blank {
    background: linear-gradient(100deg, #6c2eff 0%, #02278c 100%);
}
</style>
