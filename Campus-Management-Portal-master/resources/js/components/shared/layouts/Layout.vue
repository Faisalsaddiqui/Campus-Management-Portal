<script setup>
import IconChevronDown from "~icons/mdi/chevron-down";
import AppDropdown from "../ui/AppDropdown.vue";
import AppFlashMessage from "../ui/AppFlashMessage.vue";
</script>
<template>
    <div class="md:h-screen md:flex md:flex-col overflow-y-hidden">
        <div class="dropdown"></div>
        <header>
            <nav>
                <div class="nav-title ">
                    <a href="./dashboard" class="mt-1 text-2xl">RL Academia</a>
                    <AppDropdown class="md:hidden fill-current text-white">
                        <template v-slot:trigger>
                            <svg
                                class="fill-white w-6 h-6"
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20"
                            >
                                <path
                                    d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"
                                />
                            </svg>
                        </template>

                        <template v-slot:content>
                            <div
                                class="mt-2 px-8 py-4 shadow-lg bg-indigo-800 rounded"
                            >
                                <slot />
                            </div>
                        </template>
                    </AppDropdown>
                </div>
                <div class="nav-header">
                    <div class="mt-1 mr-4">{{ appName }}</div>
                    <AppDropdown class="mt-1">
                        <template v-slot:trigger>
                            <div
                                class="flex items-center cursor-pointer select-none group"
                            >
                                <div
                                    class="text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 mr-1 whitespace-nowrap"
                                >
                                    <span>{{ user.name }}</span>
                                </div>

                                <IconChevronDown
                                    class="w-5 h-5 group-hover:text-indigo-600 text-gray-700 focus:text-indigo-600 flex align-middle"
                                />
                            </div>
                        </template>
                        <template v-slot:content>
                            <div
                                class="mt-2 py-2 shadow-xl bg-white rounded text-sm"
                            >
                                <div class="dropdownmenu"></div>
                            </div>
                        </template>
                    </AppDropdown>
                </div>
            </nav>
        </header>
        <div class="md:flex md:flex-grow md:overflow-hidden">
            <nav
                class="hidden md:block bg-indigo-800 text-white flex-shrink-0 w-56 p-12 overflow-y-auto"
            >
                <slot />
            </nav>

            <main
                class="px-4 py-8 overflow-x-hidden md:flex-1 md:p-12 md:overflow-y-auto "
            >
                <AppFlashMessage
                    v-if="
                        $page.props.flash.success ||
                            $page.props.flash.error ||
                            Object.keys($page.props.errors).length > 0
                    "
                />
                <div class="maincontent"></div>
            </main>
        </div>
    </div>
</template>

<script>
export default {
    computed: {
        user() {
            return this.$page.props.auth.user;
        },
        appName() {
            return this.$page.props.appName;
        }
    },
    components: {
        AppFlashMessage,
        IconChevronDown,
        AppDropdown,
        AppDropdown,
        AppFlashMessage
    }
};
</script>

<style scoped>
nav {
    @apply md:flex md:flex-shrink-0;
}
.nav-title {
    @apply bg-indigo-900 text-white md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center justify-between md:justify-center;
}
.nav-header {
    @apply bg-white border-b w-full p-4 md:py-0 md:px-12 text-sm md:text-base flex justify-between items-center;
}
</style>
