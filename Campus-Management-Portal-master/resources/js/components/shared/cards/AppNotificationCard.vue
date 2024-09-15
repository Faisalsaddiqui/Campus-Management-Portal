<template>
    <!-- Refactor this to dynamically show and dismiss notification -->
    <Link
        :href="url"
        class="bg-white shadow overflow-hidden max-w-3xl flex justify-between items-center px-2 py-4 rounded-md"
        as="div"
    >
        <slot />
        <div>
            Close
        </div>
    </Link>
</template>
<script>
import { Link } from "@inertiajs/vue3";

export default {
    components: { Link },
    props: {
        url: {
            type: String,
            required: false
        }
    }
};
</script>
