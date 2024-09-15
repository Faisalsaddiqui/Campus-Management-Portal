<script setup>
import { computed } from "vue";
import ProfileCard from "../../shared/cards/ProfileCard.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    user: {
        required: true
    },
    permissions: {
        required: false
    }
});

const session = computed(() => {
    return `
			${props.user.enrollments[0].session_start} - ${props.user.enrollments[0]
        .session_start +
        props.user.enrollments[0].program.degree.semesters / 2}
			`;
});

const profileInformation = [
    {
        label: "Name",
        value: props.user.name
    },
    {
        label: "Father Name",
        value: props.user.father_name
    },
    {
        label: "Gender",
        value: props.user.gender
    },
    {
        label: "Date of birth",
        value: props.user.date_of_birth
    },
    {
        label: "Registration No",
        value: props.user.enrollments[0].registration_number
    },
    {
        label: "Session",
        value: session.value
    },
    {
        label: "Session Type",
        value: props.user.enrollments[0].session_type
    },
    {
        label: "Admission Year",
        value: props.user.enrollments[0].session_start
    }
];
</script>

<template>
    <section class="bg-white rounded-md shadow overflow-hidden max-w-3xl flex">
        <ProfileCard
            :profile-information="profileInformation"
            :image="user.avatar"
        />
    </section>
    <div v-if="permissions.update" class="py-4 my-4  max-w-3xl">
        <Link
            :href="route(`admin.users.${user.roles[0]}.edit`, user.id)"
            class="btn-main"
        >
            Edit
        </Link>
    </div>
</template>
