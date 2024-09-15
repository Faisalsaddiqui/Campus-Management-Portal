<script setup>
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

import FormInputText from "../../../components/shared/form/FormInputText.vue";
import AppBreadCrumbs from "../../../components/shared/ui/AppBreadCrumbs.vue";
import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import { TWFormInputText } from "tw-vue";

const form = useForm({
    faculty_name: ""
});

const crumbs = [
    {
        text: "Faculty",
        route: route("admin.faculties")
    },
    {
        text: "Create"
    }
];

const store = () => {
    form.post(route("admin.faculties.store"));
};
</script>
<template>
    <div>
        <TheAdminHead title="Create Faculty" />
        <AppBreadCrumbs :crumbs="crumbs" />
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form class="m-0" @submit.prevent="store">
                <div class="form-row">
                    <TWFormInputText
                        v-model="form.faculty_name"
                        label="Create Faculty"
                        :error="form.errors.faculty_name"
                    />
                </div>
                <div
                    class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center"
                >
                    <button
                        :disabled="form.processing"
                        type="submit"
                        class="btn-main"
                    >
                        Create Faculty
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
