<template>
    <div>
        <Link
            class="block px-6 py-2 hover:bg-indigo-500 hover:text-white"
            :href="route('admin.profile')"
            >My Profile</Link
        >
        <Link
            class="block px-6 py-2 hover:bg-indigo-500 hover:text-white"
            :href="route('admin.users')"
            >Manage Users</Link
        >

        <Link
            class="block px-6 py-2 hover:bg-indigo-500 hover:text-white w-full text-left"
            :href="route('logout')"
            method="post"
            as="button"
            >Logout</Link
        >
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
