<script setup>
import FormInputText from "@/components/shared/form/FormInputText.vue";
import AppDataTable from "@/components/shared/tables/AppDataTable.vue";
import AppBreadCrumbs from "@/components/shared/ui/AppBreadCrumbs.vue";
import TheAdminHead from "@/components/admin/meta/TheAdminHead.vue";
import useSweetAlert from "@/composables/useSweetAlert.js";
import { useForm } from "@inertiajs/vue3";
import { reactive, ref, watch } from "vue";

const props = defineProps({
    faculty: {
        type: Object,
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
    faculty_name: props.faculty.faculty_name
});

const labels = [
    {
        key: "department_name",
        value: "Name"
    }
];

const crumbs = reactive([
    {
        text: "Faculties",
        route: route("admin.faculties")
    },
    {
        text: props.faculty.faculty_name
    }
]);

const { alertConfirm } = useSweetAlert();

const destroy = () => {
    alertConfirm(
        result => {
            if (result.isConfirmed) {
                form.delete(
                    route("admin.faculties.destroy", props.faculty.slug)
                );
            }
        },
        { title: `Deleting ${props.faculty.faculty_name}` }
    );
};

const update = () => {
    form.put(route("admin.faculties.update", props.faculty.slug));
};

watch(form, newValue => {
    crumbs[crumbs.length - 1].text = newValue.faculty_name;
});
</script>
<template>
    <div>
        <TheAdminHead :title="form.faculty_name" />
        <AppBreadCrumbs :crumbs="crumbs" />
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="update" id="update-form" class="m-0">
                <div class="form-row">
                    <FormInputText
                        label="Faculty Name"
                        v-model="form.faculty_name"
                        :readonly="!permissions.update"
                        :error="form.errors.faculty_name"
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
                            Delete Faculty
                        </button>
                    </form>

                    <button
                        v-if="permissions.update"
                        form="update-form"
                        :disabled="form.processing"
                        type="submit"
                        class="btn-main"
                    >
                        Update Faculty
                    </button>
                </div>
            </form>
        </div>
        <h1 class="my-8 font-bold text-3xl">
            Departments
        </h1>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <AppDataTable
                resourceRoute="admin.departments.edit"
                :tableData="faculty.departments"
                :labels="labels"
            />
        </div>
    </div>
</template>
