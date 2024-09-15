<template>
    <div>
        <TheAdminHead title="Create program" />
        <AppBreadCrumbs :crumbs="crumbs" />

        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
            <form class="m-0" @submit.prevent="store">
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
                            >{{ degree.degree_name }}</option
                        >
                    </FormInputSelect>
                    <FormInputSelect
                        label="Department"
                        v-model="form.department_id"
                        :error="form.errors.department_id"
                    >
                        <option
                            v-for="department in departments"
                            :key="department.id"
                            :value="department.id"
                            >{{ department.department_name }}</option
                        >
                    </FormInputSelect>
                    <FormInputText
                        label="Credit Hours"
                        v-model="form.credit_hours"
                        :error="form.errors.credit_hours"
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
                        Create program
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

import TheAdminHead from "../../../components/admin/meta/TheAdminHead.vue";
import AppBreadCrumbs from "../../../components/shared/ui/AppBreadCrumbs.vue";
import FormInputSelect from "../../../components/shared/form/FormInputSelect.vue";
import FormInputText from "../../../components/shared/form/FormInputText.vue";

export default {
    components: {
        Link,
        TheAdminHead,
        AppBreadCrumbs,
        FormInputSelect,
        FormInputText
    },
    props: {
        departments: {
            required: true
        },
        degrees: {
            required: true
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                degree_id: "",
                department_id: "",
                credit_hours: ""
            }),

            crumbs: [
                {
                    text: "Program",
                    route: this.route("admin.programs")
                },
                {
                    text: "Create"
                }
            ]
        };
    },
    methods: {
        store() {
            this.form.post(this.route("admin.programs.store"));
        }
    }
};
</script>
