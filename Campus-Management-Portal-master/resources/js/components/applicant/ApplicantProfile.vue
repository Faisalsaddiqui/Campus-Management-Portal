<script setup>
import ProfileCard from "@/components/shared/cards/ProfileCard.vue";

const props = defineProps({
    user: {
        required: true
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
            :profile-information="profileInformation"
            :image="user.avatar"
        />
    </section>
</template>
