<template>
    <div>
        <TheAdminHead title="Programs" />

        <h1 class="mb-8 font-bold text-3xl">Programs</h1>
        <div class="mb-6 flex justify-between items-center">
            <AppTableSearch
                filterable
                v-model="form.search"
                class="w-full max-w-md mr-4"
                @reset="reset"
            >
                <label class="block text-gray-700">Degree:</label>
                <select v-model="form.degree" class="mt-1 w-full form-select">
                    <option :value="null" />
                    <option
                        v-for="degree in degrees"
                        :key="degree.id"
                        :value="degree.degree_name"
                    >
                        {{ degree.degree_name }}
                    </option>
                </select>
            </AppTableSearch>
            <Link
                v-if="permissions.create"
                as="button"
                class="btn-main"
                :href="route('admin.programs.create')"
            >
                <span>Create</span>
                <span class="hidden md:inline">Program</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <AppDataTable
                :tableData="programs.data"
                :labels="labels"
                resourceRoute="admin.programs.edit"
            />
        </div>
        <AppTablePagination class="mt-6" :links="programs.meta.links" />
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import mapValues from "lodash/mapValues";
import AppTableSearch from "../../../components/shared/tables/AppTableSearch.vue";
import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import AppDataTable from "../../../components/shared/tables/AppDataTable.vue";
import AppTablePagination from "../../../components/shared/tables/AppTablePagination.vue";

export default {
    data() {
        return {
            form: {
                search: this.filters.search,
                degree: this.filters.degree
            },
            labels: [
                {
                    key: "program_name",
                    value: "Name"
                },
                {
                    key: "department.department_name",
                    value: "Department"
                },
                {
                    key: "credit_hours",
                    value: "Credit Hours"
                }
            ]
        };
    },
    components: {
        Link,
        AppTableSearch,
        TheAdminHead,
        AppDataTable,
        AppTablePagination
    },
    props: {
        filters: {
            type: Object
        },
        programs: {
            required: true
        },
        degrees: Array,
        permissions: {
            type: Object,
            required: false,
            default: () => ({
                create: false
            })
        }
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null);
        }
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function() {
                this.$inertia.get(
                    this.route("admin.programs"),
                    pickBy(this.form),
                    {
                        preserveState: true,
                        replace: true
                    }
                );
            }, 150)
        }
    }
};
</script>
