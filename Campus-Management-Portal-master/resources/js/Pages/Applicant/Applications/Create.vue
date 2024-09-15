<script setup>
import IconChevronRight from "~icons/mdi/chevron-right";

import mapValues from "lodash/mapValues";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";
import TheApplicantHead from "../../../components/applicant/meta/TheApplicantHead.vue";
import AppTablePagination from "../../../components/shared/tables/AppTablePagination.vue";
import AppTableSearch from "../../../components/shared/tables/AppTableSearch.vue";
import AppBreadCrumbs from "../../../components/shared/ui/AppBreadCrumbs.vue";
import useSweetAlert from "@/composables/useSweetAlert.js";

import { router, useForm } from "@inertiajs/vue3";
import { reactive, watch } from "vue";

const form = useForm({
    program_id: ""
});
const searchForm = reactive({
    search: ""
});
const crumbs = [
    {
        text: "Applications",
        route: route("applicant.applications")
    },
    {
        text: "Apply"
    }
];
const props = defineProps({
    programs: {
        required: true
    },
    max_allowed: {
        required: true
    }
});

const { alertError } = useSweetAlert();

watch(
    searchForm,
    throttle(() => {
        router.get(route("applicant.applications.create"), pickBy(searchForm), {
            preserveState: true,
            replace: true
        });
    }, 150),
    { deep: true }
);

const apply = () => {
    if (!form.program_id) {
        alertError({
            title: "No program selected",
            text: "Select a program to apply"
        });
        return;
    }
    form.post(route("applicant.applications.create"));
};
const reset = () => {
    searchForm.search = null;
};
</script>
<template>
    <div>
        <TheApplicantHead title="Apply" />
        <AppBreadCrumbs :crumbs="crumbs" />
        <p class="my-1 text-xl">
            Choose program to apply. You can apply a maximum of
            {{ max_allowed }}
        </p>

        <div class="mb-6 flex justify-between items-center">
            <AppTableSearch
                v-model="searchForm.search"
                class="w-full max-w-md mr-4"
                @reset="reset"
            />
            <div
                class="flex items-center cursor-pointer select-none group my-4"
            >
                <button @click.prevent="apply" class="btn-main">
                    <span>Apply</span>
                </button>
            </div>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Name</th>

                    <th class="px-6 pt-6 pb-4"></th>
                </tr>
                <tr
                    @click="form.program_id = program.id"
                    v-for="program in programs.data"
                    :key="program.id"
                    class="hover:bg-gray-100 focus-within:bg-gray-100"
                    :class="{
                        'bg-indigo-600 text-white hover:bg-indigo-600':
                            form.program_id === program.id
                    }"
                >
                    <td class="border-t">
                        <label
                            class="px-6 py-4 flex items-center focus:text-indigo-500"
                        >
                            {{ program.program_name }}
                        </label>
                    </td>
                    <td class="border-t w-px">
                        <label class=" px-6 py-4 flex items-center ">
                            <IconChevronRight
                                :class="
                                    form.program_id === program.id
                                        ? 'text-white'
                                        : 'text-gray-600'
                                "
                            />
                        </label>
                    </td>
                </tr>
                <tr v-if="programs.data.length === 0">
                    <td class="border-t px-6 py-4" colspan="4">
                        No programs found.
                    </td>
                </tr>
            </table>
        </div>
        <AppTablePagination :links="programs.meta.links" />
    </div>
</template>
