<template>
    <main>
        <Head :title="`Register your account | ${$page.props.appName}`"></Head>
        <div class="min-h-screen flex flex-col">
            <div
                class="container max-w-sm mx-auto flex-1 flex flex-col items-center "
            >
                <form id="create-form" @submit.prevent="register">
                    <h1 class="mb-2 text-3xl text-center">Sign up</h1>
                    <p class="px-6 mb-8 text-red-500" v-if="form.hasErrors">
                        Error. Please check info.
                    </p>
                    <div
                        class="px-6"
                        v-for="(formStep, step) in steps"
                        :key="step"
                    >
                        <div v-if="currentStep === step">
                            <div v-for="(field, i) in formStep" :key="i">
                                <FormInputSelect
                                    v-if="field.type === 'select'"
                                    class="lg:w-full "
                                    :label="field.label"
                                    v-model="form[field.key]"
                                    :error="form.errors[field.key]"
                                >
                                    <option value=""
                                        >Select {{ field.label }}</option
                                    >
                                    <option
                                        v-for="(option, index) in field.options"
                                        :key="index"
                                        :value="option.value"
                                        >{{ option.label }}
                                    </option>
                                </FormInputSelect>

                                <FormInputCnic
                                    v-else-if="field.type === 'cnic'"
                                    :label="field.label"
                                    class="lg:w-full"
                                    :error="form.errors[field.key]"
                                    v-model="form[field.key]"
                                />
                                <FormInputText
                                    v-else
                                    :label="field.label"
                                    class="lg:w-full"
                                    :error="form.errors[field.key]"
                                    v-model="form[field.key]"
                                    :type="field.type"
                                />
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex gap-2 justify-between mt-5 p-6 items-center"
                    >
                        <div>
                            <button
                                v-if="isLastStep"
                                class="btn-main"
                                :disabled="form.processing"
                                type="submit"
                                form="create-form"
                            >
                                Create Account
                            </button>
                        </div>
                        <div>
                            <button
                                v-if="!isFirstStep"
                                class="btn"
                                @click.prevent="previousStep"
                            >
                                Previous
                            </button>
                            <button
                                v-if="!isLastStep"
                                class="btn btn-primary"
                                @click.prevent="nextStep"
                            >
                                Next
                            </button>
                        </div>
                    </div>
                    <div
                        class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center"
                    >
                        <div class="text-center text-sm text-grey-dark mt-4">
                            By signing up, you agree to the
                            <a
                                class="no-underline border-b border-grey-dark text-grey-dark"
                                href="#"
                            >
                                Terms of Service
                            </a>
                            and
                            <a
                                class="no-underline border-b border-grey-dark text-grey-dark"
                                href="#"
                            >
                                Privacy Policy
                            </a>
                        </div>
                    </div>
                </form>

                <div class="text-grey-dark mt-6">
                    Already have an account?
                    <a
                        class="no-underline border-b border-blue text-blue"
                        href="../login/"
                    >
                        Log in </a
                    >.
                </div>
            </div>
        </div>
    </main>
</template>

<script>
import { Head } from "@inertiajs/vue3";

import FormInputText from "../../components/shared/form/FormInputText.vue";
import FormInputSelect from "../../components/shared/form/FormInputSelect.vue";
import FormInputCnic from "../../components/shared/form/FormInputCnic.vue";

export default {
    components: { FormInputText, Head, FormInputSelect, FormInputCnic },
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
                phone: ""
            }),
            steps: [
                [
                    {
                        label: "Email",
                        key: "email",
                        type: "email"
                    },
                    {
                        label: "Password",
                        key: "password",
                        type: "password"
                    },
                    {
                        label: "Confirm Password",
                        key: "password_confirmation",
                        type: "password"
                    }
                ],
                [
                    {
                        label: "Name",
                        key: "name"
                    },
                    {
                        label: "Father Name",
                        key: "father_name"
                    },
                    {
                        label: "Gender",
                        key: "gender",
                        type: "select",
                        options: [
                            {
                                value: "male",
                                label: "Male"
                            },
                            {
                                value: "female",
                                label: "Female"
                            }
                        ]
                    }
                ],
                [
                    {
                        label: "Date of birth",
                        key: "date_of_birth",
                        type: "date"
                    },
                    { label: "Phone Number", key: "phone" },
                    { label: "CNIC", key: "cnic", type: "cnic" }
                ]
            ],
            currentStep: 0
        };
    },
    methods: {
        nextStep() {
            if (this.isLastStep) return;
            this.currentStep++;
        },
        previousStep() {
            if (this.isFirstStep) return;
            this.currentStep--;
        },
        register() {
            this.form.post(this.route("register"));
        }
    },
    computed: {
        totalSteps() {
            return this.steps.length;
        },
        isFirstStep() {
            return this.currentStep === 0;
        },
        isLastStep() {
            return this.currentStep === this.totalSteps - 1;
        }
    }
};
</script>

<style scoped>
form {
    @apply mt-4 bg-white pt-8 rounded shadow-md text-black w-full;
}
</style>
