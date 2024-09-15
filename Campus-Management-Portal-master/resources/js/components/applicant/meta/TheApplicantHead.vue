<script setup>
import { Head } from "@inertiajs/vue3";

const props = defineProps({ title: String });
</script>
<template>
    <Head :title="title ? `${title} - Applicant` : 'Apply Today - Applicant'" />
</template>
