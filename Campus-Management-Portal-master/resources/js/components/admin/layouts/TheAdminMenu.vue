<script setup>
import { onMounted, ref } from "vue";
import { Link, usePage } from "@inertiajs/vue3";

const manage_applications = ref(false);
const page = usePage();
const isUrl = (...urls) => {
    let currentUrl = page.url.substring(1);
    currentUrl = currentUrl.replace("admin/", "");
    if (urls[0] === "") {
        return currentUrl === "";
    }
    return urls.filter(url => currentUrl.startsWith(url)).length;
};

const getPermission = async () => {
    let res = await axios.get(route("api.admin.manage_applications"));
    return res.data;
};

onMounted(async () => {
    manage_applications.value = await getPermission();
});
</script>
<template>
    <div class="flex flex-col text-indigo-300">
        <div class="nav-item">
            <Link
                :class="{ 'text-white': isUrl('dashboard') }"
                class="m-2"
                :href="route('admin.dashboard')"
                >Dashboard</Link
            >
        </div>
        <div class="nav-item">
            <Link
                :class="{ 'text-white': isUrl('profile') }"
                class="m-2"
                :href="route('admin.profile')"
                >Profile</Link
            >
        </div>
        <div class="nav-item">
            <Link
                :class="{ 'text-white': isUrl('faculties') }"
                class="m-2"
                :href="route('admin.faculties')"
                >Faculties</Link
            >
        </div>
        <div class="nav-item">
            <Link
                :class="{ 'text-white': isUrl('departments') }"
                class="m-2"
                :href="route('admin.departments')"
                >Departments
            </Link>
        </div>
        <div class="nav-item">
            <Link
                :class="{ 'text-white': isUrl('programs') }"
                class="m-2"
                :href="route('admin.programs')"
                >Programs</Link
            >
        </div>
        <div class="nav-item">
            <Link
                :class="{ 'text-white': isUrl('courses') }"
                class="m-2"
                :href="route('admin.courses')"
                >Courses
            </Link>
        </div>
        <div v-if="manage_applications" class="nav-item">
            <Link
                :class="{ 'text-white': isUrl('applications') }"
                class="m-2"
                :href="route('admin.applications')"
            >
                Applications</Link
            >
        </div>
    </div>
</template>

<style scoped>
.nav-item {
    @apply my-2;
}
</style>
