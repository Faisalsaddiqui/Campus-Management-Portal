<script setup>
import AdminProfile from "../../../components/admin/AdminProfile.vue";
import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";

const props = defineProps({
    user: {
        required: true,
        type: Object
    }
});
</script>

<template>
    <main>
        <TheAdminHead title="Profile" />
        <h1 class="mb-8 font-bold text-3xl">{{ user.name }}</h1>
        <AdminProfile :user="user" />
    </main>
</template>
