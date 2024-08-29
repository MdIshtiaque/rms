<script setup>
import Frontend from "../Layouts/Frontend.vue";
import { onMounted, ref } from 'vue';

defineOptions({layout : Frontend})

const isVisible = ref(false);

onMounted(() => {
  isVisible.value = true;
});
</script>

<template>
    <Head title="About | RMS - Simplify Your Living Expenses"/>
    
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">About RMS</h1>
            <p class="text-xl mb-8">Revolutionizing expense management for modern living</p>
        </div>
    </section>

    <!-- Our Story -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0" :class="{ 'animate-fade-in-left': isVisible }">
                    <h2 class="text-3xl font-bold mb-4">Our Story</h2>
                    <p class="text-gray-600 mb-4">RMS was born out of a simple idea: living expenses shouldn't be complicated. Founded in 2020, our team of passionate developers and finance experts set out to create a solution that would simplify rent, utilities, and meal management for bachelors, renters, and property managers alike.</p>
                    <p class="text-gray-600">Today, RMS serves thousands of users worldwide, continuously evolving to meet the changing needs of modern living arrangements.</p>
                </div>
                <div class="md:w-1/2" :class="{ 'animate-fade-in-right': isVisible }">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf" alt="Team working" class="w-full h-auto rounded-lg shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Our Mission -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold mb-8">Our Mission</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">To empower individuals and communities with intuitive tools that simplify financial management, foster transparency, and promote harmonious living environments.</p>
        </div>
    </section>

    <!-- Team -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Meet Our Team</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div v-for="member in team" :key="member.id" class="text-center">
                    <img :src="member.photo" :alt="member.name" class="w-48 h-48 rounded-full mx-auto mb-4 object-cover">
                    <h3 class="text-xl font-semibold mb-2">{{ member.name }}</h3>
                    <p class="text-gray-600 mb-2">{{ member.position }}</p>
                    <p class="text-gray-500">{{ member.bio }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            team: [
                { id: 1, name: "Jane Doe", position: "CEO & Co-founder", bio: "Passionate about simplifying financial management for everyone.", photo: "https://randomuser.me/api/portraits/women/4.jpg" },
                { id: 2, name: "John Smith", position: "CTO", bio: "Tech enthusiast with a vision for user-friendly solutions.", photo: "https://randomuser.me/api/portraits/men/5.jpg" },
                { id: 3, name: "Emily Chen", position: "Head of Customer Success", bio: "Dedicated to ensuring the best experience for our users.", photo: "https://randomuser.me/api/portraits/women/6.jpg" },
            ]
        }
    }
}
</script>

<style scoped>
/* Reuse the animation styles from Home.vue */
</style>
