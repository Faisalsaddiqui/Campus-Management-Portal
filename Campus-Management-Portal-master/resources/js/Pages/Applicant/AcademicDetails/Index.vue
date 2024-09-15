<script setup>
import { Link } from "@inertiajs/vue3";

import TheApplicantHead from "../../../components/applicant/meta/TheApplicantHead.vue";
import AppDataTable from "../../../components/shared/tables/AppDataTable.vue";

const props = defineProps({
    academic_details: {
        required: true
    },
    canAdd: Boolean
});

const labels = [
    {
        key: "type",
        value: "Type"
    },
    {
        key: "title",
        value: "Title"
    },
    {
        key: "reg_no",
        value: "Reg/Roll no"
    },
    {
        key: "organization.organization_name",
        value: "From"
    },
    {
        key: "obtained_marks",
        value: "Obtained Marks"
    },
    {
        key: "total_marks",
        value: "Total Marks"
    }
];
</script>

<template>
    <div>
        <TheApplicantHead title="Academic Details" />
        <h1 class="mb-8 font-bold text-3xl">Academica Details</h1>

        <div class="mb-4">
            <Link
                :href="route('applicant.academic-details.create')"
                v-if="canAdd"
                class="btn-main"
            >
                <span>Add Details</span>
            </Link>
        </div>

        <div class="bg-white rounded-md shadow overflow-x-auto ">
            <AppDataTable :tableData="academic_details" :labels="labels" />
        </div>
    </div>
</template>
