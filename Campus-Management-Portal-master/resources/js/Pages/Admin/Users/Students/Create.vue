<template>
    <div>
        <TheAdminHead title="Create Student" />
        <AppBreadCrumbs :crumbs="crumbs" />
        <div class="overflow-hidden max-w-3xl bg-white rounded-md shadow">
            <form class="m-0" id="create-form" @submit.prevent="store">
                <div class="form-row">
                    <FormInputText
                        label="Name"
                        v-model="form.name"
                        :error="form.errors.name"
                    />
                    <FormInputText
                        label="Email"
                        v-model="form.email"
                        :error="form.errors.email"
                    />
                </div>
                <div class="form-row">
                    <FormInputText
                        label="Father Name"
                        v-model="form.father_name"
                        :error="form.errors.father_name"
                    />
                    <FormInputSelect
                        label="Gender"
                        v-model="form.gender"
                        :error="form.errors.gender"
                    >
                        <option value="" selected></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </FormInputSelect>
                </div>
                <div class="form-row">
                    <FormInputText
                        label="Phone Number"
                        v-model="form.phone"
                        :error="form.errors.phone"
                    />
                    <FormInputCnic
                        label="CNIC"
                        v-model="form.cnic"
                        :error="form.errors.cnic"
                    />
                </div>
                <div class="form-row">
                    <FormInputText
                        label="Password"
                        v-model="form.password"
                        :error="form.errors.password"
                    />
                    <FormInputText
                        label="Confirm Password"
                        v-model="form.password_confirmation"
                        :error="form.errors.password_confirmation"
                    />
                </div>
                <div class="form-row">
                    <FormInputSelect
                        label="Session Type"
                        v-model="form.session_type"
                        :error="form.errors.session_type"
                    >
                        <option value="" selected>Select session type</option>
                        <option value="morning">Morning</option>
                        <option value="evening">Evening</option>
                    </FormInputSelect>
                    <FormInputSelect
                        label="Program"
                        v-model="form.program"
                        :error="form.errors.program"
                    >
                        <option value="" selected
                            >Select program to enroll</option
                        >
                        <option
                            v-for="program in programs"
                            :key="program.id"
                            :value="program.id"
                            >{{ program.program_name }}
                        </option>
                    </FormInputSelect>
                </div>
                <div class="form-row">
                    <FormInputText
                        label="Date of birth"
                        v-model="form.date_of_birth"
                        :error="form.errors.date_of_birth"
                        type="date"
                    />
                </div>
                <div
                    class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center"
                >
                    <button
                        :disabled="form.processing"
                        type="submit"
                        class="btn-main"
                        form="create-form"
                    >
                        Create User
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import { Link } from "@inertiajs/vue3";

import FormInputText from "../../../../components/shared/form/FormInputText.vue";
import AppBreadCrumbs from "../../../../components/shared/ui/AppBreadCrumbs.vue";
import FormInputSelect from "../../../../components/shared/form/FormInputSelect.vue";
import TheAdminHead from "../../../../components/admin/meta/TheAdminHead.vue";
import FormInputCnic from "../../../../components/shared/form/FormInputCnic.vue";

export default {
    components: {
        Link,
        FormInputText,
        AppBreadCrumbs,
        FormInputSelect,
        TheAdminHead,
        FormInputCnic
    },
    props: {
        programs: {
            required: true
        }
    },
    data() {
        return {
            form: this.$inertia.form({
                name: "",
                father_name: "",
                gender: "",
                email: "",
                date_of_birth: "",
                password: "",
                password_confirmation: "",
                cnic: "",
                phone: "",
                session_type: "",
                roll_no: "",
                program: ""
            }),
            crumbs: [
                {
                    text: "Users",
                    route: this.route("admin.users")
                },
                {
                    text: "Student",
                    route: this.route("admin.users", { role: "student" })
                },
                {
                    text: "Create"
                }
            ]
        };
    },
    methods: {
        store() {
            this.form.post(this.route("admin.users.student.store"));
        }
    }
};
</script>
