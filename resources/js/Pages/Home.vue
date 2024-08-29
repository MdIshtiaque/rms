<script setup>
import Frontend from "../Layouts/Frontend.vue";
import { Link } from "@inertiajs/vue3";
import { onMounted, ref } from 'vue';

defineOptions({layout : Frontend})

const isVisible = ref(false);

onMounted(() => {
  isVisible.value = true;
});
</script>

<template>
    <Head title="| RMS - Simplify Your Living Expenses"/>
    
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20 overflow-hidden">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-10 md:mb-0" :class="{ 'animate-fade-in-left': isVisible }">
                    <h1 class="text-4xl md:text-6xl font-bold mb-4 leading-tight">Revolutionize Your Living Expenses with RMS</h1>
                    <p class="text-xl mb-8">Effortlessly manage rent, utilities, and meals. The ultimate solution for bachelors, renters, and property managers!</p>
                    <Link href="#" class="bg-white text-indigo-700 py-3 px-8 rounded-full font-bold hover:bg-indigo-100 transition duration-300 transform hover:scale-105">
                        Start Your Free 30-Day Trial
                    </Link>
                </div>
                <div class="md:w-1/2" :class="{ 'animate-fade-in-right': isVisible }">
                    <img src="https://images.unsplash.com/photo-1560448204-e02f11c3d0e2" alt="Smart Home Living" class="w-full h-auto rounded-lg shadow-2xl transform hover:rotate-2 transition duration-300">
                </div>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">Comprehensive Expense Management</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div v-for="feature in features" :key="feature.id" class="bg-white rounded-xl shadow-lg p-8 hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                    <img :src="feature.icon" :alt="feature.name" class="w-20 h-20 mb-6 mx-auto">
                    <h3 class="text-2xl font-semibold mb-4 text-center">{{ feature.name }}</h3>
                    <p class="text-gray-600 text-center">{{ feature.description }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">How RMS Works</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div v-for="step in howItWorks" :key="step.id" class="text-center">
                    <div class="bg-indigo-600 text-white rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-6 text-2xl font-bold shadow-lg">{{ step.id }}</div>
                    <h3 class="text-2xl font-semibold mb-4">{{ step.title }}</h3>
                    <p class="text-gray-600">{{ step.description }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">What Our Users Say</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                <div v-for="testimonial in testimonials" :key="testimonial.id" class="bg-white rounded-xl p-8 shadow-lg hover:shadow-2xl transition duration-300">
                    <div class="flex items-center mb-6">
                        <img :src="testimonial.avatar" :alt="testimonial.name" class="w-16 h-16 rounded-full mr-4 border-4 border-indigo-200">
                        <div>
                            <h4 class="font-semibold text-lg">{{ testimonial.name }}</h4>
                            <p class="text-indigo-600">{{ testimonial.position }}</p>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"{{ testimonial.quote }}"</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics -->
    <section class="py-20 bg-indigo-700 text-white">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16">RMS by the Numbers</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div v-for="stat in statistics" :key="stat.id" class="text-center">
                    <div class="text-5xl font-bold mb-4">{{ stat.value }}</div>
                    <p class="text-xl">{{ stat.label }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing -->
    <section class="py-20 bg-gradient-to-br from-indigo-100 to-purple-100">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center mb-16 text-indigo-800">Choose Your Perfect Plan</h2>
            <div class="flex flex-wrap justify-center gap-8">
                <div v-for="plan in pricingPlans" :key="plan.id" class="w-full md:w-80 bg-white rounded-3xl shadow-2xl overflow-hidden transform hover:-translate-y-2 transition-all duration-300">
                    <div class="h-3 bg-gradient-to-r from-indigo-500 to-purple-500"></div>
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-4 text-indigo-800">{{ plan.name }}</h3>
                        <div class="text-5xl font-extrabold mb-6 bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-500">
                            {{ plan.price }}
                            <span class="text-lg font-normal text-gray-500">/month</span>
                        </div>
                        <ul class="mb-8 space-y-4">
                            <li v-for="feature in plan.features" :key="feature" class="flex items-center text-gray-700">
                                <svg class="w-5 h-5 text-indigo-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                {{ feature }}
                            </li>
                        </ul>
                    </div>
                    <div class="px-8 pb-8">
                        <a :href="plan.ctaLink" class="block w-full text-center bg-gradient-to-r from-indigo-500 to-purple-500 text-white py-3 px-4 rounded-xl font-semibold hover:opacity-90 transition duration-300">
                            {{ plan.ctaText }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-20 bg-gradient-to-r from-purple-600 to-indigo-600 text-white">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold mb-8">Ready to simplify your living expenses?</h2>
            <p class="text-xl mb-12 max-w-2xl mx-auto">Join thousands of satisfied users and take control of your finances today. Start your journey to stress-free expense management with RMS!</p>
            <Link href="#" class="bg-white text-indigo-700 py-4 px-12 rounded-full font-bold text-lg hover:bg-indigo-100 transition duration-300 transform hover:scale-105 inline-block">
                Get Started Now - It's Free!
            </Link>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            features: [
                { id: 1, name: "Smart Rent Management", description: "Automate rent collection, track payments, and generate financial reports with ease.", icon: "https://img.icons8.com/fluency/96/000000/home.png" },
                { id: 2, name: "Utility Bill Splitting", description: "Effortlessly divide and track utility expenses among roommates or tenants.", icon: "https://img.icons8.com/fluency/96/000000/electricity.png" },
                { id: 3, name: "Meal Planning & Cost Sharing", description: "Organize group meals, split grocery costs, and manage shared food expenses.", icon: "https://img.icons8.com/fluency/96/000000/restaurant.png" },
            ],
            howItWorks: [
                { id: 1, title: "Sign Up", description: "Create your RMS account in minutes and set up your profile." },
                { id: 2, title: "Add Property & Expenses", description: "Input your living space details and recurring expenses." },
                { id: 3, title: "Invite Roommates", description: "Add your roommates or tenants to share and manage expenses together." },
                { id: 4, title: "Automate & Relax", description: "Let RMS handle expense tracking, reminders, and payments for you." },
            ],
            testimonials: [
                { id: 1, quote: "RMS has transformed how we manage our shared apartment. It's eliminated all the awkward money conversations!", name: "Alex Johnson", position: "Graduate Student", avatar: "https://randomuser.me/api/portraits/men/1.jpg" },
                { id: 2, quote: "As a landlord, RMS has streamlined my property management process. I can't imagine going back to spreadsheets.", name: "Sarah Lee", position: "Property Investor", avatar: "https://randomuser.me/api/portraits/women/2.jpg" },
                { id: 3, quote: "The meal planning feature is a game-changer for our house. We're saving money and eating better!", name: "Mike Chen", position: "Young Professional", avatar: "https://randomuser.me/api/portraits/men/3.jpg" },
            ],
            statistics: [
                { id: 1, value: "50,000+", label: "Active Users" },
                { id: 2, value: "$2M+", label: "Monthly Rent Processed" },
                { id: 3, value: "98%", label: "User Satisfaction" },
                { id: 4, value: "4.8/5", label: "App Store Rating" },
            ],
            pricingPlans: [
                {
                    id: 1,
                    name: "Starter",
                    price: "$4.99",
                    features: [
                        "Up to 3 roommates",
                        "Basic rent tracking",
                        "Simple utility splitting",
                        "Email support",
                        "Mobile app access"
                    ],
                    ctaLink: "#",
                    ctaText: "Start Free Trial"
                },
                {
                    id: 2,
                    name: "Basic",
                    price: "$9.99",
                    features: [
                        "Up to 5 roommates",
                        "Advanced rent tracking",
                        "Detailed utility splitting",
                        "Basic meal planning",
                        "Chat support",
                        "Mobile app access"
                    ],
                    ctaLink: "#",
                    ctaText: "Start Free Trial"
                },
                {
                    id: 3,
                    name: "Pro",
                    price: "$19.99",
                    features: [
                        "Up to 10 roommates",
                        "Full rent management",
                        "Advanced utility tracking",
                        "Comprehensive meal planning",
                        "Expense analytics",
                        "Priority support",
                        "API access"
                    ],
                    ctaLink: "#",
                    ctaText: "Start Free Trial"
                },
                {
                    id: 4,
                    name: "Enterprise",
                    price: "Custom",
                    features: [
                        "Unlimited roommates",
                        "Full expense management suite",
                        "Custom integrations",
                        "Dedicated account manager",
                        "24/7 phone support",
                        "Onsite training",
                        "Custom reporting"
                    ],
                    ctaLink: "#",
                    ctaText: "Contact Sales"
                }
            ]
        }
    }
}
</script>

<style scoped>
.animate-fade-in-left {
  animation: fadeInLeft 1s ease-out;
}

.animate-fade-in-right {
  animation: fadeInRight 1s ease-out;
}

@keyframes fadeInLeft {
  from {
    opacity: 0;
    transform: translateX(-50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes fadeInRight {
  from {
    opacity: 0;
    transform: translateX(50px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}
</style>
