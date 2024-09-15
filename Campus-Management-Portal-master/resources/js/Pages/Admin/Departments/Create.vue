<script setup>
import { Link } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";

import AppBreadCrumbs from "../../../components/shared/ui/AppBreadCrumbs.vue";
import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import { TWFormInputSelect, TWFormInputText } from "tw-vue";

const props = defineProps({
    faculties: {
        required: true
    }
});

const form = useForm({
    department_name: "",
    faculty_id: ""
});

const crumbs = [
    {
        text: "Department",
        route: route("admin.departments")
    },
    {
        text: "Create"
    }
];

const store = () => {
    form.post(route("admin.departments.store"));
};
</script>
<template>
    <div>
        <TheAdminHead title="Create department" />

        <AppBreadCrumbs :crumbs="crumbs" />

        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form class="m-0" @submit.prevent="store">
                <div class="form-row">
                    <TWFormInputText
                        label="Department Name"
                        v-model="form.department_name"
                        :error="form.errors.department_name"
                    />

                    <TWFormInputSelect
                        label="Faculty"
                        v-model="form.faculty_id"
                        :error="form.errors.faculty_id"
                    >
                        <option
                            v-for="faculty in faculties"
                            :key="faculty.id"
                            :value="faculty.id"
                            >{{ faculty.faculty_name }}</option
                        >
                    </TWFormInputSelect>
                </div>
                <div
                    class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center"
                >
                    <button
                        :disabled="form.processing"
                        type="submit"
                        class="btn-main"
                    >
                        Create department
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
