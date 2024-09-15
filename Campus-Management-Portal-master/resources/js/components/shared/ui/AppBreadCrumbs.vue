<template>
    <h1 class="wrapper">
        <span v-for="(crumb, index) in crumbs" :key="index">
            <span v-if="!isLast(index)">
                <Link class="crumb" :href="crumb.route">{{ crumb.text }}</Link>
                <span class="text-indigo-400 font-medium"> / </span>
            </span>
            <span v-else>{{ crumb.text }}</span>
        </span>
    </h1>
</template>

<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: {
        Link
    },
    props: {
        crumbs: {
            type: Array,
            required: true
        }
    },

    methods: {
        isLast(index) {
            return index === this.crumbs.length - 1;
        }
    }
};
</script>

<style scoped>
.wrapper {
    @apply mb-8 font-bold text-3xl;
}

.crumb {
    @apply text-indigo-400 hover:text-indigo-600;
}
</style>
