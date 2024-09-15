<script setup>
import { Head } from "@inertiajs/vue3";
import axios from "axios";
import { ref } from "vue";

const manage_applications = ref(false);
const props = defineProps({ title: String });
</script>
<template>
    <Head :title="title ? `${title} - Admin` : 'CMS - Admin'" />
</template>
