<script setup>
import { useForm } from "@inertiajs/vue3";

import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import AppBreadCrumbs from "../../../components/shared/ui/AppBreadCrumbs.vue";
import FormInputText from "../../../components/shared/form/FormInputText.vue";

const form = useForm({
    course_name: "",
    practical_credit_hours: "",
    theory_credit_hours: "",
    department_code: "",
    course_code: ""
});

const crumbs = [
    {
        text: "Course",
        route: route("admin.courses")
    },
    {
        text: "Create"
    }
];

const store = () => {
    form.post(route("admin.courses.store"));
};
</script>

<template>
    <div>
        <TheAdminHead title="Create course" />
        <AppBreadCrumbs :crumbs="crumbs" />

        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form class="m-0" @submit.prevent="store">
                <div class="form-row">
                    <FormInputText
                        class="lg:w-full"
                        label="Course Name"
                        v-model="form.course_name"
                        :error="form.errors.course_name"
                    />
                </div>
                <div class="form-row">
                    <FormInputText
                        label="Practical Credit Hours"
                        v-model="form.practical_credit_hours"
                        :error="form.errors.practical_credit_hours"
                        type="number"
                        max="99"
                        min="0"
                    />
                    <FormInputText
                        label="Theory Credit Hours"
                        v-model="form.theory_credit_hours"
                        :error="form.errors.theory_credit_hours"
                        max="99"
                        min="0"
                    />
                    <FormInputText
                        label="Department Code"
                        v-model="form.department_code"
                        :error="form.errors.department_code"
                    />
                    <FormInputText
                        label="Course Code"
                        v-model="form.course_code"
                        :error="form.errors.course_code"
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
                        Create course
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
