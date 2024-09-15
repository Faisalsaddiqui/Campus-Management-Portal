<script setup>
import FormInputText from "@/components/shared/form/FormInputText.vue";
import AppDataTable from "@/components/shared/tables/AppDataTable.vue";
import AppBreadCrumbs from "@/components/shared/ui/AppBreadCrumbs.vue";
import TheAdminHead from "@/components/admin/meta/TheAdminHead.vue";
import useSweetAlert from "@/composables/useSweetAlert.js";
import { useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";
import FormInputSelect from "../../../components/shared/form/FormInputSelect.vue";

const props = defineProps({
    department: {
        type: Object,
        required: true
    },
    faculties: {
        type: Array,
        required: true
    },
    permissions: {
        type: Object,
        default: () => {
            return {
                update: false,
                delete: false
            };
        }
    }
});

const form = useForm({
    department_name: props.department.department_name,
    faculty_id: props.department.faculty_id
});

const crumbs = reactive([
    {
        text: props.department.faculty_name,
        route: route("admin.faculties")
    },
    {
        text: props.department.department_name
    }
]);

const { alertConfirm } = useSweetAlert();

const destroy = () => {
    alertConfirm(
        result => {
            if (result.isConfirmed) {
                form.delete(
                    route("admin.departments.destroy", props.department.slug)
                );
            }
        },
        { title: `Deleting ${props.department.department_name}` }
    );
};

const update = () => {
    form.put(route("admin.departments.update", props.department.slug));
};

watch(form, newValue => {
    crumbs[crumbs.length - 1].text = newValue.department_name;
});
</script>

<template>
    <div>
        <TheAdminHead :title="form.department_name" />
        <AppBreadCrumbs :crumbs="crumbs" />

        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="update" id="update-form" class="m-0">
                <div class="form-row">
                    <FormInputText
                        v-model="form.department_name"
                        label="Department Name"
                        :error="form.errors.department_name"
                    />
                    <FormInputSelect
                        v-model="form.faculty_id"
                        label="Faculty"
                        :error="form.errors.faculty_id"
                    >
                        <option
                            v-for="faculty in faculties"
                            :key="faculty.id"
                            :value="faculty.id"
                        >
                            {{ faculty.faculty_name }}
                        </option>
                    </FormInputSelect>
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
                            Delete Department
                        </button>
                    </form>

                    <button
                        v-if="permissions.update"
                        form="update-form"
                        :disabled="form.processing"
                        type="submit"
                        class="btn-main"
                    >
                        Update Department
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
