<script setup>
import { useForm } from "@inertiajs/vue3";
import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import FormInputText from "../../../components/shared/form/FormInputText.vue";
import AppBreadCrumbs from "../../../components/shared/ui/AppBreadCrumbs.vue";
import useSweetAlert from "@/composables/useSweetAlert.js";
import { reactive, watch } from "vue";

const props = defineProps({
    course: {
        type: Object,
        required: true
    },
    permissions: {
        type: Object,
        default: () => {
            return {
                delete: false
            };
        }
    }
});

const form = useForm({
    course_name: props.course.course_name,
    practical_credit_hours: props.course.practical_credit_hours,
    theory_credit_hours: props.course.theory_credit_hours,
    department_code: props.course.department_code,
    course_code: props.course.course_code
});

const crumbs = reactive([
    {
        text: "Courses",
        route: route("admin.courses")
    },
    {
        text: props.course.course_name
    }
]);

watch(form, newValue => {
    crumbs[crumbs.length - 1].text = newValue.course_name;
});

const update = () => {
    form.put(route("admin.courses.update", props.course.id));
};

const { alertConfirm } = useSweetAlert();

const destroy = () => {
    alertConfirm(
        result => {
            if (result.isConfirmed)
                form.delete(route("admin.courses.destroy", props.course.id));
        },
        { title: `Deleting ${props.course.course_name}` }
    );
};
</script>

<template>
    <div>
        <TheAdminHead :title="form.course_name" />
        <AppBreadCrumbs :crumbs="crumbs" />

        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="update" id="update-form" class="m-0">
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
                        label="Theory Credit Hours"
                        v-model="form.theory_credit_hours"
                        :error="form.errors.theory_credit_hours"
                        type="number"
                        max="99"
                        min="0"
                    />
                    <FormInputText
                        label="Practical Credit Hours"
                        v-model="form.practical_credit_hours"
                        :error="form.errors.practical_credit_hours"
                        type="number"
                        max="99"
                        min="0"
                    />
                </div>
                <div class="form-row">
                    <FormInputText
                        label="Department Code"
                        v-model="form.department_code"
                        :error="form.errors.department_code"
                    />

                    <FormInputText
                        label="Course Code"
                        v-model="form.course_code"
                        :error="form.errors.course_code"
                        type="number"
                        max="999"
                        min="0"
                    />
                </div>
                <div
                    class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center"
                >
                    <form
                        v-if="permissions.delete"
                        @submit.prevent="destroy"
                        id="delete-from"
                        class="m-0"
                    >
                        <button
                            form="delete-from"
                            :disabled="form.processing"
                            type="submit"
                            class="hover:underline text-red-600 "
                        >
                            Delete course
                        </button>
                    </form>

                    <button
                        form="update-form"
                        :disabled="form.processing"
                        type="submit"
                        class="btn-main"
                    >
                        Update course
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
