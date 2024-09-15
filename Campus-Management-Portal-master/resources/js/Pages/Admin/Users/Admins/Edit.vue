<script setup>
import { useForm } from "@inertiajs/vue3";
import TheAdminHead from "../../../../components/admin/meta/TheAdminHead.vue";
import AppBreadCrumbs from "../../../../components/shared/ui/AppBreadCrumbs.vue";
import FormInputText from "../../../../components/shared/form/FormInputText.vue";
import useSweetAlert from "@/composables/useSweetAlert.js";

import FormInputSwitch from "../../../../components/shared/form/FormInputSwitch.vue";
import { reactive, watch } from "vue";

const props = defineProps({
    user: {
        type: Object,
        required: true
    },
    permissions: {
        type: Object,
        required: true
    },
    faculties: Array
});

const { alertConfirm } = useSweetAlert();

const form = useForm({
    name: props.user.name,
    permissions: props.user.permissions,
    faculties: props.user.faculties
});

const crumbs = reactive([
    {
        text: "Users",
        route: route("admin.users")
    },
    {
        text: props.user.name
    }
]);

watch(form, newValue => {
    crumbs[crumbs.length - 1].text = newValue.name;
});

const update = () => {
    form.put(route("admin.users.admin.update", props.user.id));
};
const destroy = () => {
    alertConfirm(
        result => {
            if (result.isConfirmed) {
                form.delete(route("admin.users.destroy", props.user.id));
            }
        },
        {
            title: `Deleting user ${props.user.name}`
        }
    );
};
</script>
<template>
    <div>
        <TheAdminHead :title="form.name" />
        <AppBreadCrumbs :crumbs="crumbs" />
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form @submit.prevent="update" id="update-form" class="m-0">
                <div class="form-row">
                    <FormInputText
                        label="User Name"
                        v-model="form.name"
                        :error="form.errors.name"
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
                            Delete user
                        </button>
                    </form>

                    <button
                        form="update-form"
                        :disabled="form.processing"
                        type="submit"
                        class="btn-main"
                    >
                        Update user
                    </button>
                </div>
            </form>
        </div>
        <h1 class="my-8 font-bold text-3xl">
            Faculties
        </h1>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Faculty</th>
                </tr>
                <tr
                    v-for="faculty in form.faculties"
                    :key="faculty.id"
                    class="hover:bg-gray-100 focus-within:bg-gray-100"
                    @click="faculty.owns_faculty = !faculty.owns_faculty"
                >
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            {{ faculty.faculty_name }}
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            <input
                                type="checkbox"
                                v-model="faculty.owns_faculty"
                            />
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <h1 class="my-8 font-bold text-3xl">
            Permissions
        </h1>
        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Name</th>
                    <th class="px-6 pt-6 pb-4">Create</th>
                    <th class="px-6 pt-6 pb-4">Edit</th>
                    <th class="px-6 pt-6 pb-4">Delete</th>
                </tr>
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            Faculty
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            <input
                                type="checkbox"
                                v-model="form.permissions.create_faculties"
                            />
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            <input
                                type="checkbox"
                                v-model="form.permissions.update_faculties"
                            />
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            <input
                                type="checkbox"
                                v-model="form.permissions.delete_faculties"
                            />
                        </span>
                    </td>
                </tr>
                <tr class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            User
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            <input
                                type="checkbox"
                                v-model="form.permissions.create_users"
                            />
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            <input
                                type="checkbox"
                                v-model="form.permissions.update_users"
                            />
                        </span>
                    </td>
                    <td class="border-t">
                        <span class="px-6 py-4 flex items-center" tabindex="-1">
                            <input
                                type="checkbox"
                                v-model="form.permissions.delete_users"
                            />
                        </span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="grid sm:grid-cols-2 grid-cols-1 max-w-3xl">
            <div>
                <h4 class="mb-5 mt-8 font-bold text-2xl">
                    Manage Application
                </h4>
                <FormInputSwitch
                    id="applicationSwitch"
                    v-model="form.permissions.manage_applications"
                />
            </div>
            <div>
                <h4 class="mb-5 mt-8 font-bold text-2xl">
                    Manage Enrollments
                </h4>
                <FormInputSwitch
                    id="enrollmentsSwitch"
                    v-model="form.permissions.manage_enrollments"
                />
            </div>
        </div>
    </div>
</template>
