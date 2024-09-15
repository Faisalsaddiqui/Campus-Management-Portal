<script setup>
import { Link } from "@inertiajs/vue3";
import ProfileCard from "../shared/cards/ProfileCard.vue";

const props = defineProps({
    user: {
        required: true
    },
    permissions: {
        required: false
    }
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
    }
];
</script>

<template>
    <section class="bg-white rounded-md shadow overflow-hidden max-w-3xl flex">
        <ProfileCard
            :image="user.avatar"
            :profile-information="profileInformation"
        />
    </section>
    <div v-if="permissions?.update" class="py-4 my-4  max-w-3xl">
        <Link
            :href="route(`admin.users.${user.roles[0]}.edit`, user.id)"
            class="btn-main"
        >
            Edit
        </Link>
    </div>
</template>
