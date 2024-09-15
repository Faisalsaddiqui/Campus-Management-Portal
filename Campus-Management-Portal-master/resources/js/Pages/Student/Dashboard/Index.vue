<template>
    <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl ">
        <TheAdminHead title="Dashboard - Student" />

        <h1>Welcome, {{ user.name }}</h1>
        <p>Hello welcome to your first Inertia app!</p>
    </div>
</template>

<script>
import { Head } from "@inertiajs/vue3";

export default {
    components: {
        Head
    },
    computed: {
        user() {
            return this.$page.props.auth.user;
        }
    }
};
</script>
