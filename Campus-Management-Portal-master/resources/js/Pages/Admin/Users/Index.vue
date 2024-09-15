<script setup>
import { Link } from "@inertiajs/vue3";

import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";

import AppTableSearch from "../../../components/shared/tables/AppTableSearch.vue";
import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import AppDataTable from "../../../components/shared/tables/AppDataTable.vue";
import AppTablePagination from "../../../components/shared/tables/AppTablePagination.vue";
import { router } from "@inertiajs/vue3";

import IconChevronDown from "~icons/mdi/chevron-down";
import { computed, reactive, watch } from "vue";
import AppDropdown from "../../../components/shared/ui/AppDropdown.vue";

const props = defineProps({
    filters: Object,
    users: Object,
    permissions: Object,
    roles: Array
});

const form = reactive({
    search: props.filters.search,
    role: props.filters.role
});
const labels = [
    {
        value: "Name",
        key: "name"
    },
    {
        value: "Email",
        key: "email"
    },
    {
        value: "Role",
        key: "roles"
    }
];

watch(
    form,
    throttle(() => {
        router.get(route("admin.users"), pickBy(form), {
            preserveState: true,
            preserveScroll: true
        });
    }, 200),
    { deep: true }
);

const reset = () => {
    form.search = null;
    form.role = null;
};

const modifiedUsers = computed(() => {
    return props.users.data.map(user => ({
        ...user,
        roles: user.roles.join(", ")
    }));
});
</script>

<template>
    <div>
        <TheAdminHead title="Users" />
        <h1 class="mb-8 font-bold text-3xl">Users</h1>
        <div class="mb-6 flex justify-between items-center">
            <AppTableSearch
                filterable
                v-model="form.search"
                class="w-full max-w-md mr-4"
                @reset="reset"
            >
                <label class="block text-gray-700">Role:</label>
                <select
                    v-model="form.role"
                    class="mt-1 w-full form-select capitalize"
                >
                    <option :value="null" />
                    <option
                        v-for="role in roles"
                        :key="role.id"
                        :value="role.name"
                        class="capitalize"
                    >
                        {{ role.name.replace("-", " ") }}
                    </option>
                </select>
            </AppTableSearch>
            <AppDropdown>
                <template v-slot:trigger>
                    <div
                        class="flex items-center cursor-pointer select-none group"
                    >
                        <button class="btn-main">
                            <span>Create</span>
                            <span class="hidden md:inline">User </span>

                            <IconChevronDown
                                class="w-5 h-5 text-white inline-flex align-middle"
                            />
                        </button>
                    </div>
                </template>
                <template v-slot:content>
                    <div class="py-2 shadow-xl bg-white rounded text-sm">
                        <div>
                            <Link
                                class="block px-6 py-2 hover:bg-indigo-500 hover:text-white"
                                :href="route('admin.users.admin.create')"
                                >Admin</Link
                            >
                            <!-- <Link class="block px-6 py-2 hover:bg-indigo-500 hover:text-white"
							:href="route('admin.users.teacher.create')">Teacher</Link> -->

                            <Link
                                class="block px-6 py-2 hover:bg-indigo-500 hover:text-white"
                                :href="route('admin.users.student.create')"
                                >Student</Link
                            >
                        </div>
                    </div>
                </template>
            </AppDropdown>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <AppDataTable
                :tableData="modifiedUsers"
                :labels="labels"
                resourceRoute="admin.users.show"
            />
        </div>
        <AppTablePagination class="mt-6" :links="users.meta.links" />
    </div>
</template>
