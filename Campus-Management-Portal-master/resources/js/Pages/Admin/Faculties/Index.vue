<script setup>
import { Link, router } from "@inertiajs/vue3";
import { reactive } from "vue";
import pickBy from "lodash/pickBy";
import AppDataTable from "@/components/shared/tables/AppDataTable.vue";
import AppTablePagination from "@/components/shared/tables/AppTablePagination.vue";
import AppTableSearch from "@/components/shared/tables/AppTableSearch.vue";
import TheAdminHead from "@/components/admin/meta/TheAdminHead.vue";
import { watchThrottled } from "@vueuse/core";

const props = defineProps({
    filters: {
        type: Object
    },
    faculties: {
        required: false
    },
    permissions: {
        type: Object,
        required: false,
        default: () => ({
            create: false
        })
    }
});

const labels = [
    {
        key: "faculty_name",
        value: "Name"
    }
];

const form = reactive({
    search: props.filters.search
});

const reset = () => {
    form.search = null;
};

watchThrottled(
    form,
    () => {
        router.get(route("admin.faculties"), pickBy(form), {
            preserveState: true,
            replace: true
        });
    },
    {
        throttle: 500
    }
);
</script>

<template>
    <div>
        <TheAdminHead title="Faculties" />

        <h1 class="mb-8 font-bold text-3xl">Faculties</h1>
        <div class="mb-6 flex justify-between items-center">
            <AppTableSearch
                v-model="form.search"
                class="w-full max-w-md mr-4"
                @reset="reset"
            />

            <Link
                v-if="permissions.create"
                as="button"
                class="btn-main"
                :href="route('admin.faculties.create')"
            >
                <span>Create</span>
                <span class="hidden md:inline"> faculty</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <AppDataTable
                resourceRoute="admin.faculties.edit"
                :labels="labels"
                :tableData="faculties.data"
            />
        </div>
        <AppTablePagination class="mt-6" :links="faculties.meta.links" />
    </div>
</template>
