<script setup>
import { ref } from 'vue';
import {
    ArrowLeftStartOnRectangleIcon,
    ChevronDownIcon,
    ChevronUpIcon,
    CogIcon,
    HomeIcon,
    UserCircleIcon,
    Bars3BottomRightIcon,
    Bars3Icon,
    UserIcon
} from "@heroicons/vue/24/solid";
import { Link } from "@inertiajs/vue3";  // Make sure this import is correct

const isSidebarVisible = ref(true);
const activeLink = ref('Home'); // Default active link
const submenuVisibility = ref({});
const toggleSidebar = () => {
    isSidebarVisible.value = !isSidebarVisible.value;
};

// Toggles the visibility of submenus
const toggleSubmenu = (name) => {
    // Automatically close other submenus when one is opened
    if (!submenuVisibility.value[name]) {
        for (const key in submenuVisibility.value) {
            submenuVisibility.value[key] = false;
        }
    }
    submenuVisibility.value[name] = !submenuVisibility.value[name];
};

const setActiveLink = (link) => {
    activeLink.value = link;
    // Close all submenus when selecting a main menu item that doesn't have submenus
    if (!link.includes('/')) {
        for (const key in submenuVisibility.value) {
            submenuVisibility.value[key] = false;
        }
    }
    if (window.innerWidth <= 768) {
        isSidebarVisible.value = false;
    }
};

const isLinkActive = (name) => {
    return activeLink.value.startsWith(name);
};
const isParentActive = (parent) => {
    return Object.keys(submenuVisibility.value).some(
        key => key.startsWith(parent) && submenuVisibility.value[key] && isLinkActive(parent)
    );
};
</script>


<template>
    <div class="flex w-full h-screen">
        <!-- Sidebar -->
        <div
            :class="`sidebar transition-width duration-700 ease-out ${isSidebarVisible ? 'w-[100%] sm:w-[15%]' : 'w-0'} h-full text-white shadow-lg`">
            <div class="flex flex-col items-center w-full p-4">
                <img src="../../../public/assets/logo3.png" 
                     class="h-16 w-16 sm:h-20 sm:w-20 md:h-24 md:w-24 mb-4 rounded-full border-2 border-gray-700 transition-all duration-300"
                     alt="Logo">
                <hr class="w-full border-gray-600">
            </div>
            <nav class="mt-5 px-2">
                <ul class="space-y-2">
                    <Link
                        href="/admin/dashboard"
                        class="flex items-center active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ 'active': $page.component === 'Backend/Dashboard' }"
                        @click="setActiveLink('Dashboard')"
                    >
                        <HomeIcon class="h-5 w-5 mr-3" />
                        Dashboard
                    </Link>
                    <Link href="/admin/users"
                        class="flex items-center active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ 'active': $page.component === 'Backend/User' }" @click="setActiveLink('Users')">
                    <UserCircleIcon class="h-5 w-5 mr-3" />
                    Users
                    </Link>
                    <li class="flex items-center justify-between active-hover px-4 py-2 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                        :class="{ 'parent-active': isParentActive('Profile') }" @click="toggleSubmenu('Profile')">
                        <div class="flex items-center">
                            <UserCircleIcon class="h-5 w-5 mr-3" />
                            Profile
                        </div>
                        <!-- Submenu indicator toggle -->
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
                        <li class="flex px-2 py-1 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                            :class="{ 'submenu-active': isLinkActive('Profile/Account') }"
                            @click="setActiveLink('Profile/Account')">
                            <UserIcon class="h-5 w-5 mr-3" />
                            Account
                        </li>
                        <li class="flex px-2 py-1 cursor-pointer transition-all duration-300 ease-in-out rounded-[45px_10px_45px]"
                            :class="{ 'submenu-active': isLinkActive('Profile/Logout') }"
                            @click="setActiveLink('Profile/Logout')">
                            <ArrowLeftStartOnRectangleIcon class="h-5 w-5 mr-3" />
                            Logout
                        </li>
                    </ul>
                </ul>
            </nav>
        </div>

        <!-- Main Content Area -->
        <div
            :class="`flex flex-col transition-width duration-300 ease-in-out ${isSidebarVisible && !isSidebarVisible ? 'w-[100%] sm:w-[85%]' : 'w-full'}`"
        >
            <div
                class="top-bar w-full h-16 bg-gradient-to-r from-blue-500 to-blue-700 text-white flex justify-between items-center p-5 shadow-md">
                <button @click="toggleSidebar" class="focus:outline-none" aria-label="Toggle Sidebar">
                    <Bars3Icon v-if="!isSidebarVisible" class="h-6 w-6" />
                    <Bars3BottomRightIcon v-else class="h-6 w-6" />
                </button>

                <Link href="/logout" method="post" as="button" type="button"
                    class="flex gap-2 focus:outline-none header font-bold cursor-pointer shadow-2xl transition-colors duration-300 ease-in-out transform hover:text-indigo-600 active:scale-95 active:shadow-none"
                    aria-label="Logout">
                <ArrowLeftStartOnRectangleIcon class="h-6 w-6" />
                Logout
                </Link>
            </div>
            <!-- Scrollable content area -->
            <div class="flex-1 overflow-y-auto">
                <slot />
            </div>
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
    flex: 1;
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
</style>
