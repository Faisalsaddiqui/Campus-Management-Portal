<script setup>
import pickBy from "lodash/pickBy";
import TheAdminHead from "@/components/admin/meta/TheAdminHead.vue";
import AppDataTable from "@/components/shared/tables/AppDataTable.vue";
import AppTablePagination from "@/components/shared/tables/AppTablePagination.vue";
import AppTableSearch from "@/components/shared/tables/AppTableSearch.vue";
import { watchThrottled } from "@vueuse/core";
import { router } from "@inertiajs/vue3";
import { reactive, computed } from "vue";

const form = reactive({
    search: "",
    status: ""
});

const labels = [
    {
        key: "user.name",
        value: "Name"
    },
    {
        key: "program.program_name",
        value: "Program"
    },
    {
        key: "status",
        value: "Status"
    }
];
const props = defineProps({
    statuses: Array,
    applications: {
        type: Object
    }
});

const appliedCount = computed(() => {
    return props.applications.length;
});

const reset = () => {
    form.search = null;
    form.status = null;
};

watchThrottled(
    form,
    () => {
        router.get(route("admin.applications"), pickBy(form), {
            preserveState: true,
            replace: true
        });
    },
    { throttle: 500 }
);
</script>

<template>
    <div>
        <TheAdminHead title="Applications" />
        <h1 class="mb-8 font-bold text-3xl">Application</h1>

        <div class="mb-6 flex justify-between items-center">
            <AppTableSearch
                v-model="form.search"
                class="w-full max-w-md mr-4"
                @reset="reset"
                filterable
            >
                <label class="block text-gray-700">Degree:</label>
                <select
                    v-model="form.status"
                    class="mt-1 w-full capitalize form-select"
                >
                    <option :value="null" />
                    <option
                        v-for="status in statuses"
                        :key="status.id"
                        :value="status.status"
                    >
                        {{ status.status }}
                    </option>
                </select>
            </AppTableSearch>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <AppDataTable
                :labels="labels"
                :tableData="applications.data"
                resourceRoute="admin.applications.show"
            />
        </div>
        <AppTablePagination class="mt-6" :links="applications.meta.links" />
    </div>
</template>
