<script setup>
import {
  ArrowLeftStartOnRectangleIcon,
  Bars3BottomRightIcon,
  Bars3Icon,
  ChevronDownIcon,
  ChevronUpIcon,
  CogIcon,
  HomeIcon,
  UserCircleIcon,
  XMarkIcon
} from '@heroicons/vue/24/solid';
import { Link } from '@inertiajs/vue3';
import { onMounted, onUnmounted, ref } from 'vue';
import { ChatBubbleLeftRightIcon } from '@heroicons/vue/24/solid';
import Chatbot from '@/Components/Chatbot.vue';

const isSidebarVisible = ref(true);
const activeLink = ref('Home'); // Default active link
const submenuVisibility = ref({});

const isUserMenuVisible = ref(false);

const toggleUserMenu = () => {
    isUserMenuVisible.value = !isUserMenuVisible.value;
};

const isMobile = ref(window.innerWidth <= 768);

const toggleSidebar = () => {
    isSidebarVisible.value = !isSidebarVisible.value;
    if (isMobile.value && !isSidebarVisible.value) {
        document.body.style.overflow = 'auto';
    } else if (isMobile.value) {
        document.body.style.overflow = 'hidden';
    }
};

const toggleSubmenu = (name) => {
    if (!submenuVisibility.value[name]) {
        for (const key in submenuVisibility.value) {
            submenuVisibility.value[key] = false;
        }
    }
    submenuVisibility.value[name] = !submenuVisibility.value[name];
};

const setActiveLink = (link) => {
    activeLink.value = link;
    if (!link.includes('/')) {
        for (const key in submenuVisibility.value) {
            submenuVisibility.value[key] = false;
        }
    }
    if (isMobile.value) {
        isSidebarVisible.value = false;
        document.body.style.overflow = 'auto';
    }
};

const isLinkActive = (name) => {
    return activeLink.value.startsWith(name);
};

const isParentActive = (parent) => {
    return Object.keys(submenuVisibility.value).some(
        (key) => key.startsWith(parent) && submenuVisibility.value[key] && isLinkActive(parent)
    );
};

const isChatbotOpen = ref(false);

const toggleChatbot = () => {
    isChatbotOpen.value = !isChatbotOpen.value;
};

onMounted(() => {
    window.addEventListener('resize', () => {
        isMobile.value = window.innerWidth <= 768;
    });
});

onUnmounted(() => {
    window.removeEventListener('resize', () => {
        isMobile.value = window.innerWidth <= 768;
    });
});
</script>

<template>

    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        <div :class="`sidebar transition-all duration-700 ease-out ${isSidebarVisible ? 'ml-0' : '-ml-[28rem] md:-ml-64'} ${isMobile ? 'fixed inset-0 z-50' : ''} h-full text-white shadow-lg`"
            :style="{ width: isMobile ? '100%' : '256px' }">
            <div class="flex flex-col items-center w-full p-4">
                <button v-if="isMobile" @click="toggleSidebar" class="absolute top-4 right-4 text-white">
                    <XMarkIcon class="h-6 w-6" />
                </button>
                <div class="flex items-center justify-center w-full mb-4">
                    <img src="../../../public/assets/logo3.png"
                        class="h-16 w-16 rounded-full border-2 border-blue-400 shadow-md transition-all duration-300 hover:scale-105"
                        alt="Logo" />
                    <h1 class="ml-3 text-xl font-bold text-white">RMS</h1>
                </div>
                <hr class="w-full border-blue-300 opacity-30 mb-4" />
                <!-- Compact User information section -->
                <div class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 rounded-lg p-3 shadow-md relative">
                    <div class="flex items-center space-x-3">
                     <img class="h-10 w-10 rounded-full border-2 border-white shadow-sm"
                        :src="$page.props.auth.user.profileImage ? `/storage/${$page.props.auth.user.profileImage}` : 'https://via.placeholder.com/150'"
                          alt="User avatar">

                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">
                                {{ $page.props.auth.user.name }}
                            </p>
                            <p class="text-xs text-blue-200 truncate">
                                {{ $page.props.auth.user.email }}
                            </p>
                            <div
                                class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                {{ $page.props.auth.user.role || 'Admin' }}
                            </div>
                        </div>
                        <div class="relative">
                            <button @click="toggleUserMenu"
                                class="text-white hover:text-yellow-300 transition-colors duration-200 focus:outline-none">
                                <CogIcon class="h-5 w-5" />
                            </button>
                            <!-- User menu dropdown -->
                            <div v-if="isUserMenuVisible"
                                class="absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                <Link href="/admin/profile"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Your Profile</Link>
                                <Link href="/admin/settings"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Settings</Link>
                                <hr class="my-1">
                                <Link href="/logout" method="post" as="button"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Sign out</Link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="w-full border-blue-300 opacity-30 mb-4" />
            <nav class="mt-6 px-2">
                <ul class="space-y-2">
                    <Link href="/admin/dashboard"
                        class="flex items-center active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ active: $page.component === 'Backend/Dashboard' }"
                        @click="setActiveLink('Dashboard')">
                    <HomeIcon class="h-5 w-5 mr-3" />
                    Dashboard
                    </Link>
                    <Link href="/admin/users"
                        class="flex items-center active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ active: $page.component === 'Backend/Users' }" @click="setActiveLink('Users')">
                    <UserCircleIcon class="h-5 w-5 mr-3" />
                    Users
                    </Link>
                    <li class="flex items-center justify-between active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ 'parent-active': isParentActive('Profile') }" @click="toggleSubmenu('Profile')"
                        :aria-expanded="submenuVisibility['Profile']">
                        <div class="flex items-center">
                            <UserCircleIcon class="h-5 w-5 mr-3" />
                            Profile
                        </div>
                        <span v-if="submenuVisibility['Profile']">
                            <ChevronUpIcon class="h-5 w-5" />
                        </span>
                        <span v-else>
                            <ChevronDownIcon class="h-5 w-5" />
                        </span>
                    </li>
                    <!-- Submenu items -->
                    <ul v-if="submenuVisibility['Profile']" class="pl-8 space-y-1">
                        <li class="flex px-2 py-1 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                            :class="{ 'submenu-active': isLinkActive('Profile/Settings') }"
                            @click="setActiveLink('Profile/Settings')">
                            <CogIcon class="h-5 w-5 mr-3" />
                            Settings
                        </li>
                    </ul>
                </ul>
            </nav>
        </div>

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top bar -->
            <header class="bg-gradient-to-r from-blue-500 to-blue-700 shadow-sm z-10">
                <div class="w-full mx-auto py-4 px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between text-white">
                        <button @click="toggleSidebar" class="text-white focus:outline-none focus:text-white">
                            <Bars3Icon v-if="!isSidebarVisible" class="h-6 w-6" />
                            <Bars3BottomRightIcon v-else class="h-6 w-6" />
                        </button>
                        <div class="flex items-center">
                            <Link href="/logout" method="post" as="button" type="button"
                                class="flex gap-2 focus:outline-none header font-bold cursor-pointer shadow-2xl transition-colors duration-300 ease-in-out transform hover:text-indigo-600 active:scale-95 active:shadow-none"
                                aria-label="Logout">
                            <ArrowLeftStartOnRectangleIcon class="h-6 w-6 hover:text-indigo-600" />
                            <span class="hidden md:block">Logout</span>
                            </Link>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="w-full h-full mx-auto spx-6 md:px-8">
                    <slot></slot>
                </div>
            </main>
        </div>

        <!-- Chatbot -->
        <div class="fixed bottom-4 right-4 z-50">
            <button @click="toggleChatbot" class="bg-blue-600 hover:bg-blue-700 text-white rounded-full p-3 shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <ChatBubbleLeftRightIcon class="h-6 w-6" />
            </button>
            <Chatbot v-if="isChatbotOpen" @close="toggleChatbot" />
        </div>
    </div>
</template>

<style scoped>
.active,
.active-hover:hover {
    background: linear-gradient(100deg, #02278c 0%, #02278c 100%);
    border-radius: 45px 10px 45px;
}

.sidebar {
    overflow: hidden;
    background: linear-gradient(0deg, #4e54c8 0%, #8f94fb 100%);
}

.top-bar {
    background: linear-gradient(90deg, #4e54c8 0%, #8f94fb 100%);
}

.submenu-active,
.submenu-active:hover {
    background: linear-gradient(120deg, #02278c 0%, #0356fc 100%);
    border-radius: 30px 10px 30px;
}

.parent-active {
    font-weight: bold;
    color: snow;
}

.overflow-y-auto {
    overflow-y: auto;
}

@media (max-width: 768px) {
    .sidebar {
        background: linear-gradient(0deg, #4e54c8 0%, #8f94fb 100%);
    }
}
</style>
