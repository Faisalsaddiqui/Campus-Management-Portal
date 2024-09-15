<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import FormInputText from "../../components/shared/form/FormInputText.vue";

const form = useForm({
    email: "admin@mail.com", //For testing purpose, set null later.
    password: "password",
    remember: true
});
</script>

<template>
    <main
        class="p-6 bg-indigo-800 min-h-screen flex justify-center items-center"
    >
        <Head>
            <title>Login</title>
        </Head>
        <form
            class="bg-white rounded-md py-8 px-6 my-10"
            @submit.prevent="form.post('/login')"
        >
            <div class="my-4">
                <FormInputText
                    label="Email"
                    v-model="form.email"
                    :error="form.errors.email"
                    class="lg:w-full pb-4"
                />
            </div>
            <div class="my-4">
                <FormInputText
                    label="Password"
                    v-model="form.password"
                    :error="form.errors.password"
                    class="lg:w-full"
                />
            </div>
            <div class="my-4">
                <input type="checkbox" v-model="form.remember" /> Remember Me
            </div>
            <div class="my-2">
                <button
                    class="btn-main"
                    type="submit"
                    :disabled="form.processing"
                >
                    Login
                </button>
            </div>
        </form>
    </main>
</template>
