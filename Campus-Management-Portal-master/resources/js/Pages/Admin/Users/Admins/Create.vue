<script setup>
import { Link, useForm } from "@inertiajs/vue3";

import AppBreadCrumbs from "../../../../components/shared/ui/AppBreadCrumbs.vue";
import FormInputText from "../../../../components/shared/form/FormInputText.vue";
import FormInputSelect from "../../../../components/shared/form/FormInputSelect.vue";
import TheAdminHead from "../../../../components/admin/meta/TheAdminHead.vue";
import FormInputCnic from "../../../../components/shared/form/FormInputCnic.vue";

const form = useForm({
    name: "",
    father_name: "",
    gender: "",
    email: "",
    password: "",
    password_confirmation: "",
    cnic: "",
    phone: "",
    date_of_birth: ""
});

const crumbs = [
    {
        text: "Users",
        route: route("admin.users")
    },
    {
        text: "Admin",
        route: route("admin.users", { role: "admin" })
    },
    {
        text: "Create"
    }
];

const store = () => {
    form.post(route("admin.users.admin.store"));
};
</script>
<template>
    <div>
        <TheAdminHead title="Create Admin" />
        <AppBreadCrumbs :crumbs="crumbs" />

        <div class="bg-white rounded-md shadow overflow-hidden max-w-3xl">
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
