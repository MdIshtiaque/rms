<script setup>
import Frontend from "../Layouts/Frontend.vue";
import {Link} from "@inertiajs/vue3";
import Bubble from "../Components/Bubble.vue";
defineOptions({layout: Frontend})
</script>

<template>
    <div class="flex w-full h-screen">
        <div class="relative flex flex-col justify-center items-start pl-[5%] w-2/5 h-screen blank">
            <Bubble />
            <h1 class="text-7xl font-bold text-slate-50">Welcome</h1>
            <h1 class="text-7xl font-bold text-slate-50">To</h1>
            <h1 class="text-7xl font-bold text-slate-50">RMS</h1>
            <p class="mt-8 text-lg text-slate-100 max-w-lg">
                RMS is a comprehensive system designed to streamline the management of all your living expenses. From handling flat rent and utilities to organizing meal costs, RMS simplifies every aspect of shared living, making it easier for bachelors and renters to stay on top of their finances.
            </p>
        </div>

        <div class="flex-row justify-center w-3/5 h-screen input-background">
            <h1 class="title mt-28">Sign in to your account</h1>
            <div class="w-2/4 mt-32 mx-auto">
                <form>
                    <div class="mb-6">
                        <label>Email</label>
                        <input type="text" name="" id="">
                    </div>
                    <div class="mb-6">
                        <label>Password</label>
                        <input type="password" name="" id="">
                    </div>
                    <div class="mb-6">
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
.blank{
    background: linear-gradient(100deg, #6c2eff 0%, #02278c 100%);
}
</style>
