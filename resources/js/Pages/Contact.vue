<script setup>
import Frontend from "../Layouts/Frontend.vue";
import { onMounted, ref } from 'vue';

defineOptions({layout : Frontend})

const isVisible = ref(false);

onMounted(() => {
  isVisible.value = true;
});

const form = ref({
  name: '',
  email: '',
  subject: '',
  message: ''
});

const submitForm = () => {
  // Handle form submission logic here
  console.log('Form submitted:', form.value);
  // Reset form after submission
  form.value = { name: '', email: '', subject: '', message: '' };
};
</script>

<template>
    <Head title="Contact | RMS - Simplify Your Living Expenses"/>
    
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-4">Contact Us</h1>
            <p class="text-xl mb-8">We're here to help with any questions or concerns</p>
        </div>
    </section>

    <!-- Contact Form and Info -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row gap-12">
                <!-- Contact Form -->
                <div class="md:w-2/3" :class="{ 'animate-fade-in-left': isVisible }">
                    <h2 class="text-3xl font-bold mb-8">Get in Touch</h2>
                    <form @submit.prevent="submitForm" class="space-y-6">
                        <div>
                            <label for="name" class="block text-gray-700 mb-2">Name</label>
                            <input type="text" id="name" v-model="form.name" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" v-model="form.email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="subject" class="block text-gray-700 mb-2">Subject</label>
                            <input type="text" id="subject" v-model="form.subject" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500">
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700 mb-2">Message</label>
                            <textarea id="message" v-model="form.message" rows="5" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-indigo-500"></textarea>
                        </div>
                        <button type="submit" class="bg-indigo-600 text-white py-3 px-8 rounded-lg hover:bg-indigo-700 transition duration-300">Send Message</button>
                    </form>
                </div>
                
                <!-- Contact Information -->
                <div class="md:w-1/3" :class="{ 'animate-fade-in-right': isVisible }">
                    <h2 class="text-3xl font-bold mb-8">Contact Information</h2>
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Address</h3>
                            <p class="text-gray-600">123 RMS Street, Tech City, TC 12345</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Phone</h3>
                            <p class="text-gray-600">+1 (555) 123-4567</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Email</h3>
                            <p class="text-gray-600">support@rmsapp.com</p>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold mb-2">Business Hours</h3>
                            <p class="text-gray-600">Monday - Friday: 9am - 5pm</p>
                            <p class="text-gray-600">Saturday: 10am - 2pm</p>
                            <p class="text-gray-600">Sunday: Closed</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Frequently Asked Questions</h2>
            <div class="space-y-8 max-w-3xl mx-auto">
                <div v-for="faq in faqs" :key="faq.id" class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-semibold mb-2">{{ faq.question }}</h3>
                    <p class="text-gray-600">{{ faq.answer }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            faqs: [
                { id: 1, question: "How do I get started with RMS?", answer: "Sign up for a free account on our website, add your property details, and invite your roommates or tenants to join." },
                { id: 2, question: "Is my financial information secure?", answer: "Yes, we use bank-level encryption to protect all your sensitive data and never store complete payment information on our servers." },
                { id: 3, question: "Can I use RMS for multiple properties?", answer: "Absolutely! RMS supports managing multiple properties under a single account for landlords and property managers." },
                { id: 4, question: "How does the bill splitting feature work?", answer: "You can easily input shared expenses and RMS will automatically calculate each person's share based on your predetermined settings." }
            ]
        }
    }
}
</script>

<style scoped>
/* Reuse the animation styles from Home.vue */
</style>
