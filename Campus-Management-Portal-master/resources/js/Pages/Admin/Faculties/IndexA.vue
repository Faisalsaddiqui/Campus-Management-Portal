<template>
    <div>
        <TheAdminHead title="Faculties" />

        <h1 class="mb-8 font-bold text-3xl">Faculties</h1>
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
                :href="route('admin.faculties.create')"
            >
                <span>Create</span>
                <span class="hidden md:inline">faculty</span>
            </Link>
        </div>
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full whitespace-nowrap">
                <tr class="text-left font-bold">
                    <th class="px-6 pt-6 pb-4">Name</th>
                </tr>
                <tr
                    v-for="faculty in faculties.data"
                    :key="faculty.id"
                    class="hover:bg-gray-100 focus-within:bg-gray-100"
                >
                    <td class="border-t">
                        <Link
                            class="px-6 py-4 flex items-center focus:text-indigo-500"
                            :href="route('admin.faculties.edit', faculty.slug)"
                        >
                            {{ faculty.faculty_name }}
                        </Link>
                    </td>
                    <td class="border-t w-px">
                        <Link
                            class="px-4 flex items-center"
                            :href="route('admin.faculties.edit', faculty.slug)"
                            tabindex="-1"
                        >
                            <i class="fas fa-angle-right text-gray-600"></i
                        ></Link>
                    </td>
                </tr>
                <tr v-if="faculties.data.length === 0">
                    <td class="border-t px-6 py-4" colspan="4">
                        No faculties found.
                    </td>
                </tr>
            </table>
        </div>
        <AppTablePagination class="mt-6" :links="faculties.links" />
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

import throttle from "lodash/throttle";
import pickBy from "lodash/pickBy";
import mapValues from "lodash/mapValues";

export default {
    data() {
        return {
            form: {
                search: this.filters.search
            }
        };
    },
    components: {
        Link
    },
    props: {
        filters: {
            type: Object
        },
        faculties: {
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
                    this.route("admin.faculties"),
                    pickBy(this.form),
                    {
                        preserveState: true
                    }
                );
            }, 150)
        }
    }
};
</script>
