<script setup>
import FormInputText from "@/components/shared/form/FormInputText.vue";
import AppDataTable from "@/components/shared/tables/AppDataTable.vue";
import AppBreadCrumbs from "@/components/shared/ui/AppBreadCrumbs.vue";
import TheAdminHead from "@/components/admin/meta/TheAdminHead.vue";
import useSweetAlert from "@/composables/useSweetAlert.js";
import { Link, useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import FormInputSelect from "../../../components/shared/form/FormInputSelect.vue";
import AppModal from "../../../components/shared/modals/AppModal.vue";
import FormInputSwitch from "../../../components/shared/form/FormInputSwitch.vue";

const props = defineProps({
    program: {
        type: Object,
        required: true
    },
    departments: {
        type: Array,
        required: true
    },
    degrees: {
        type: Array,
        required: true
    },
    permissions: {
        type: Object,
        default: () => {
            return {
                delete: false
            };
        }
    },
    courses: Array
});

const form = useForm({
    degree_id: props.program.degree.id,
    department_id: props.program.department.id,
    credit_hours: props.program.credit_hours,
    morning_option: props.program.morning_option,
    evening_option: props.program.evening_option
});

const show = ref(false);

const labels = [
    {
        key: "course_name",
        value: "Name"
    },
    {
        key: "course_code",
        value: "Course Code"
    },
    {
        key: "credit_hours",
        value: "Credit Hours"
    },
    {
        key: "semester",
        value: "Semester"
    }
];

const crumbs = reactive([
    {
        text: props.program.department.department_name,
        route: route("admin.departments.edit", props.program.department.slug)
    },
    {
        text: "Program",
        route: route("admin.programs")
    },
    {
        text: props.program.program_name
    }
]);

const { alertConfirm } = useSweetAlert();

const destroy = () => {
    alertConfirm(
        result => {
            if (result.isConfirmed) {
                form.delete(
                    route("admin.programs.destroy", props.program.slug)
                );
            }
        },
        { title: `Deleting ${props.program.program_name}` }
    );
};

const update = () => {
    form.put(route("admin.programs.update", props.program.slug));
};
</script>

<template>
    <div>
        <TheAdminHead :title="`${program.program_name}`" />
        <AppModal modalWidth="w-3xl" @close="show = false" v-if="show">
            <div class="my-6 p-4 grid grid-cols-3 mx-4">
                <Link
                    v-for="(semester, index) in program.degree.semesters"
                    :key="index"
                    class="m-4"
                    :href="
                        route('admin.programs.courses', [
                            program.slug,
                            semester
                        ])
                    "
                >
                    Semester {{ semester }}
                </Link>
            </div>
        </AppModal>

        <AppBreadCrumbs :crumbs="crumbs" />

        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="update" id="update-form" class="m-0">
                <div class="form-row">
                    <FormInputSelect
                        label="Degree"
                        :error="form.errors.degree_id"
                        v-model="form.degree_id"
                    >
                        <option
                            v-for="degree in degrees"
                            :key="degree.id"
                            :value="degree.id"
                        >
                            {{ degree.degree_name }}
                        </option>
                    </FormInputSelect>

                    <FormInputSelect
                        label="Department"
                        :error="form.errors.department_id"
                        v-model="form.department_id"
                    >
                        <option
                            v-for="department in departments"
                            :key="department.id"
                            :value="department.id"
                        >
                            {{ department.department_name }}
                        </option>
                    </FormInputSelect>
                </div>
                <div class="form-row">
                    <FormInputText
                        label="Credit Hours"
                        :error="form.errors.credit_hours"
                        v-model="form.credit_hours"
                        type="number"
                        min="0"
                    />
                </div>
                <div class="form-row flex justify-between !mr-0">
                    <div>
                        <p>Morning</p>
                        <FormInputSwitch
                            :error="form.errors.morning_option"
                            v-model="form.morning_option"
                        />
                    </div>
                    <div>
                        <p>Evening</p>
                        <FormInputSwitch
                            :error="form.errors.evening_option"
                            v-model="form.evening_option"
                        />
                    </div>
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
                            Delete program
                        </button>
                    </form>

                    <button
                        form="update-form"
                        :disabled="form.processing"
                        type="submit"
                        class="btn-main"
                    >
                        Update program
                    </button>
                </div>
            </form>
        </div>

        <h1 class="my-8 font-bold text-3xl">Courses</h1>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <AppDataTable
                :tableData="courses"
                :labels="labels"
                resourceRoute="admin.courses.edit"
            />
        </div>
        <div class="mt-4">
            <a class="btn-main " @click.prevent="show = true">
                Add Course
            </a>
        </div>
    </div>
</template>
