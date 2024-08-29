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
    <Head title="Services | RMS - Simplify Your Living Expenses"/>
    
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Our Services</h1>
            <p class="text-xl mb-8">Comprehensive solutions for modern living expense management</p>
        </div>
    </section>

    <!-- Services Overview -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div v-for="service in services" :key="service.id" class="bg-gray-50 rounded-xl p-8 shadow-lg hover:shadow-2xl transition duration-300" :class="{ 'animate-fade-in': isVisible }">
                    <img :src="service.icon" :alt="service.name" class="w-20 h-20 mb-6 mx-auto">
                    <h3 class="text-2xl font-semibold mb-4 text-center">{{ service.name }}</h3>
                    <p class="text-gray-600 text-center">{{ service.description }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Comparison -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Feature Comparison</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow-lg rounded-lg">
                    <thead>
                        <tr class="bg-indigo-600 text-white">
                            <th class="py-4 px-6 text-left">Feature</th>
                            <th class="py-4 px-6 text-center">Basic</th>
                            <th class="py-4 px-6 text-center">Pro</th>
                            <th class="py-4 px-6 text-center">Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="feature in features" :key="feature.id" class="border-b">
                            <td class="py-4 px-6 font-medium">{{ feature.name }}</td>
                            <td class="py-4 px-6 text-center">{{ feature.basic ? '✓' : '✗' }}</td>
                            <td class="py-4 px-6 text-center">{{ feature.pro ? '✓' : '✗' }}</td>
                            <td class="py-4 px-6 text-center">{{ feature.enterprise ? '✓' : '✗' }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">What Our Clients Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div v-for="testimonial in testimonials" :key="testimonial.id" class="bg-gray-50 rounded-xl p-8 shadow-lg">
                    <p class="text-gray-600 italic mb-4">"{{ testimonial.quote }}"</p>
                    <div class="flex items-center">
                        <img :src="testimonial.avatar" :alt="testimonial.name" class="w-12 h-12 rounded-full mr-4">
                        <div>
                            <h4 class="font-semibold">{{ testimonial.name }}</h4>
                            <p class="text-gray-500">{{ testimonial.position }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-indigo-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-8">Ready to simplify your living expenses?</h2>
            <p class="text-xl mb-12 max-w-2xl mx-auto">Join thousands of satisfied users and take control of your finances today.</p>
            <a href="#" class="bg-white text-indigo-600 py-3 px-8 rounded-full font-bold hover:bg-indigo-100 transition duration-300">Get Started Now</a>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            services: [
                { id: 1, name: "Rent Management", description: "Streamline rent collection and tracking for landlords and tenants.", icon: "https://img.icons8.com/fluency/96/000000/home.png" },
                { id: 2, name: "Utility Bill Splitting", description: "Easily divide and manage shared utility expenses among roommates.", icon: "https://img.icons8.com/fluency/96/000000/electricity.png" },
                { id: 3, name: "Expense Tracking", description: "Keep detailed records of all shared living expenses and payments.", icon: "https://img.icons8.com/fluency/96/000000/money.png" },
            ],
            features: [
                { id: 1, name: "Rent Tracking", basic: true, pro: true, enterprise: true },
                { id: 2, name: "Bill Splitting", basic: true, pro: true, enterprise: true },
                { id: 3, name: "Multiple Properties", basic: false, pro: true, enterprise: true },
                { id: 4, name: "Advanced Reporting", basic: false, pro: true, enterprise: true },
                { id: 5, name: "API Access", basic: false, pro: false, enterprise: true },
            ],
            testimonials: [
                { id: 1, quote: "RMS has made managing our shared apartment so much easier. No more awkward conversations about money!", name: "Sarah Johnson", position: "Tenant", avatar: "https://randomuser.me/api/portraits/women/1.jpg" },
                { id: 2, quote: "As a landlord, RMS has streamlined my entire rental process. I couldn't be happier with the results.", name: "Michael Chen", position: "Property Owner", avatar: "https://randomuser.me/api/portraits/men/2.jpg" },
                { id: 3, quote: "The bill splitting feature is a game-changer. It's saved us so much time and prevented any disputes.", name: "Emily Rodriguez", position: "Student", avatar: "https://randomuser.me/api/portraits/women/3.jpg" },
            ]
        }
    }
}
</script>

<style scoped>
/* Reuse the animation styles from Home.vue */
</style>
