<template>
    <div class="flex flex-col text-indigo-300">
        <div class="nav-item">
            <Link
                :class="{ 'text-white': $page.url.endsWith('dashboard') }"
                class="m-2"
                href="./dashboard"
                >Dashboard</Link
            >
        </div>
        <div class="nav-item">
            <Link
                :class="{ 'text-white': $page.url.endsWith('profile') }"
                class="m-2"
                href="./profile"
                >Profile</Link
            >
        </div>
        <div class="nav-item">
            <Link
                :class="{ 'text-white': $page.url.endsWith('course-details') }"
                class="m-2"
                href="./course-details"
                >Course Details</Link
            >
        </div>

        <!-- Sending sloted main content through portal -->
        <Teleport to=".maincontent"> <slot /> </Teleport>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link
    }
};
</script>
<style scoped>
.nav-item {
    @apply my-2;
}
</style>
