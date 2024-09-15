<script setup>
import { computed } from "vue";
import TheApplicantHead from "../../../components/applicant/meta/TheApplicantHead.vue";
import AppDataTable from "../../../components/shared/tables/AppDataTable.vue";
import useSweetAlert from "@/composables/useSweetAlert.js";
import { router } from "@inertiajs/vue3";

const labels = [
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
    user: {
        required: true
    },
    applications: {
        type: Array
    },
    max_allowed: {
        type: Number
    },
    canApply: Boolean
});

const appliedCount = computed(() => {
    return props.applications.filter(app => {
        return app.status !== "rejected";
    }).length;
});

const { alertConfirm } = useSweetAlert();

const redirect = () => {
    if (!props.canApply) {
        alertConfirm(
            result => {
                if (result.isConfirmed)
                    router.get(route("applicant.academic-details.create"));
            },
            {
                title: `You dont have required academic qualifications added.`,
                text: "Add now?",
                confirmButtonText: "Add now",
                confirmButtonColor: "green"
            }
        );
    } else {
        router.get(route("applicant.applications.create"));
    }
};
</script>
<template>
    <div>
        <TheApplicantHead title="Applications" />
        <h1 class="mb-8 font-bold text-3xl">Applied Degrees</h1>

        <div class="mb-4">
            <button
                @click="redirect"
                v-if="appliedCount < max_allowed"
                class="btn-main"
            >
                <span>Apply</span>
            </button>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <AppDataTable :labels="labels" :tableData="applications" />
        </div>

        <div class="bg-white rounded-md shadow px-6 py-4 my-4">
            <p>
                You can apply for {{ max_allowed }} different programs at a
                time. You can apply again if you are rejected.
            </p>

            <p v-if="appliedCount && appliedCount < max_allowed">
                You have applied for {{ appliedCount }}
            </p>
            <p v-else-if="!appliedCount">
                You havent applied for any programs. Apply Today!
            </p>
            <p v-else>
                Max amount applied. Wait for the status to update.
            </p>
        </div>
    </div>
</template>
