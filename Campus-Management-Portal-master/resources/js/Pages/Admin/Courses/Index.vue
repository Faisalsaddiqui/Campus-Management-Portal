<template>
    <div>
        <TheAdminHead title="Courses" />
        <h1 class="mb-8 font-bold text-3xl">Courses</h1>
        <div class="mb-6 flex justify-between items-center">
            <AppTableSearch
                v-model="form.search"
                class="w-full max-w-md mr-4"
                @reset="reset"
            />

            <Link
                v-if="permissions.create"
                as="button"
                class="btn-main"
                :href="route('admin.courses.create')"
            >
                <span>Create</span>
                <span class="hidden md:inline">Course</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <AppDataTable
                :tableData="courses.data"
                :labels="labels"
                resourceRoute="admin.courses.edit"
            />
        </div>
        <AppTablePagination class="mt-6" :links="courses.meta.links" />
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import mapValues from "lodash/mapValues";
import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import AppTableSearch from "../../../components/shared/tables/AppTableSearch.vue";
import AppTablePagination from "../../../components/shared/tables/AppTablePagination.vue";
import AppDataTable from "../../../components/shared/tables/AppDataTable.vue";

export default {
    data() {
        return {
            form: {
                search: this.filters.search
            },
            labels: [
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
                }
            ]
        };
    },
    components: {
        Link,
        TheAdminHead,
        AppTableSearch,
        AppTablePagination,
        AppDataTable
    },
    props: {
        filters: {
            type: Object
        },
        courses: {
            required: false
        },
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
                    this.route("admin.courses"),
                    pickBy(this.form),
                    {
                        preserveState: true,
                        replace: true
                    }
                );
            }, 300)
        }
    }
};
</script>
