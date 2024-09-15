<script setup>
import { router } from "@inertiajs/vue3";
import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import AppBreadCrumbs from "../../../components/shared/ui/AppBreadCrumbs.vue";
import AppButton from "../../../components/shared/ui/AppButton.vue";

const props = defineProps({
    application: {
        required: true
    }
});

const crumbs = [
    {
        text: "Applications",
        route: route("admin.applications")
    },
    {
        text: `${props.application.user.name}'s application`
    }
];

const approve = () => {
    router.put(
        route("admin.applications.update", {
            application: props.application.id,
            status: "accepted"
        })
    );
};

const reject = () => {
    router.put(
        route("admin.applications.update", {
            application: props.application.id,
            status: "rejected"
        })
    );
};
</script>

<template>
    <div>
        <TheAdminHead :title="`${application.user.name}'s application`" />
        <AppBreadCrumbs :crumbs="crumbs" />
        <div
            class="bg-white rounded-md shadow overflow-hidden max-w-3xl px-2 py-4 mb-6"
        >
            <h1 class="font-bold text-3xl pb-2">Applicant Details</h1>
            <ul>
                <li>Name: {{ application.user.name }}</li>
                <li>Email: {{ application.user.email }}</li>
                <li>CNIC: {{ application.user.cnic }}</li>
                <li>Phone Number: {{ application.user.phone }}</li>
                <li>Gender: {{ application.user.gender }}</li>
                <li>
                    Age:
                    {{ application.user.age }}
                </li>
            </ul>
        </div>
        <div
            class="bg-white space-y-2 rounded-md shadow overflow-hidden max-w-3xl px-2 py-4 mb-6"
        >
            <h1 class="font-bold text-3xl pb-2">Academic Details</h1>
            <div
                v-for="detail in application.user.academicDetails"
                :key="detail.id"
            >
                <h4 class="uppercase text-xs text-gray-600">
                    {{ detail.type }}
                </h4>
                <ul>
                    <li>
                        Title:
                        <span class="font-semibold">{{ detail.title }}</span>
                    </li>
                    <li>
                        Registeration Number:
                        <span class="font-semibold"> {{ detail.reg_no }} </span>
                    </li>
                    <li>Passing year: {{ detail.passing_year }}</li>
                    <li>From: {{ detail.organization.organization_name }}</li>
                    <li>
                        Marks: {{ detail.obtained_marks }}/{{
                            detail.total_marks
                        }}
                    </li>
                </ul>
                <div>
                    <img :src="detail.image" alt="" />
                </div>
            </div>
        </div>

        <div
            class="bg-white rounded-md shadow overflow-hidden max-w-3xl px-2 py-4"
        >
            <h1 class="font-bold text-3xl pb-2">Application</h1>
            <h4 class="uppercase text-xs text-gray-600">
                {{ application.status }}
            </h4>
            <ul>
                <li>
                    For:
                    <span class="font-semibold"
                        >{{ application.program.program_name }} ({{
                            application.program.credit_hours
                        }}
                        credit hours)</span
                    >
                </li>
                <li>
                    Submitted At:
                    <span class="font-semibold"> {{ application.date }} </span>
                </li>
            </ul>
            <div
                v-if="
                    application.status !== 'accepted' &&
                        application.status !== 'rejected'
                "
                class="flex gap-2 mt-4"
            >
                <form @submit.prevent="approve">
                    <AppButton class="bg-green-600" text="Approve" />
                </form>
                <form @submit.prevent="reject">
                    <AppButton class="bg-red-600" text="Reject" />
                </form>
            </div>
        </div>
    </div>
</template>
