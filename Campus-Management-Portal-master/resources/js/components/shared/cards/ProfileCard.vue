<script setup>
import AppUserAvatar from "@/components/shared/AppUserAvatar.vue";

const props = defineProps({
    profileInformation: {
        required: true
    },
    image: {
        required: true
    }
});
</script>

<template>
    <section
        class="bg-white rounded-md shadow overflow-hidden max-w-3xl flex flex-col flex-grow sm:flex-row"
    >
        <AppUserAvatar :avatar="image" />
        <div class="profile p-4">
            <p v-for="(info, index) in profileInformation" :key="index">
                <span class="font-bold">{{ info.label }}: </span>
                <span class="capitalize">
                    {{ info.value ? info.value : "N/A" }}
                </span>
            </p>
        </div>
    </section>
</template>

<style scoped>
.profile {
    display: grid;
    grid-template-rows: repeat(5, 1fr);
    grid-auto-flow: column;
    column-gap: 2rem;
}

@media screen and (max-width: 920px) {
    .profile {
        display: block;
    }
}
</style>
