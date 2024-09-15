<script setup>
import { Link } from "@inertiajs/vue3";

import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import { computed } from "vue";

const props = defineProps({
    user: {
        required: true,
        type: Object
    },
    permissions: {
        type: Object,
        required: false
    }
});

const role = computed(() => {
    return props.user.roles[0];
});
</script>

<template>
    <main>
        <TheAdminHead :title="`User ${user.name}`" />
        <h3 class="mb-8 font-bold text-3xl">{{ user.name }}</h3>

        <component
            :permissions="permissions"
            :user="user"
            :is="`${role}-profile`"
        ></component>
    </main>
</template>

<script>
import AdminProfile from "@/components/admin/AdminProfile.vue";
import StudentProfile from "@/components/student/cards/StudentProfile.vue";
import ApplicantProfile from "@/components/applicant/ApplicantProfile.vue";

export default {
    components: {
        AdminProfile,
        StudentProfile,
        ApplicantProfile
    }
};
</script>
