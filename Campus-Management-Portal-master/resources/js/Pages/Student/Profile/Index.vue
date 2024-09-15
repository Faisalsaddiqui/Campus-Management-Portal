<template>
    <main>
        <TheAdminHead title="Profile - Student" />

        <StudentProfileCard :user="user" />
    </main>
</template>

<script>
import { Head } from "@inertiajs/vue3";
export default {
    components: {
        Head
    },
    props: {
        user: {
            required: true,
            type: Object
        }
    }
};
</script>
