<script setup>
import { onMounted, ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const page = usePage();
const isUrl = (...urls) => {
    let currentUrl = page.url.substring(1);
    currentUrl = currentUrl.replace("applicant/", "");
    if (urls[0] === "") {
        return currentUrl === "";
    }
    return urls.filter(url => currentUrl.startsWith(url)).length;
};
</script>
<template>
    <div class="flex flex-col text-indigo-300 space-y-4">
        <Link
            :class="{ 'text-white': isUrl('dashboard') }"
            class=""
            :href="route('applicant.dashboard')"
            >Dashboard</Link
        >
        <Link
            :class="{ 'text-white': isUrl('applications') }"
            class=""
            :href="route('applicant.applications')"
            >Applications</Link
        >
        <Link
            :class="{ 'text-white': isUrl('academic_details') }"
            class=" block"
            :href="route('applicant.academic-details')"
            >Academic Details</Link
        >
    </div>
</template>
