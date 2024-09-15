<template>
    <form id="create-form" class="m-0" @submit.prevent="store">
        <div v-if="formStep === 1">
            <AppUserStep :form="form" />
        </div>
        <div v-else-if="formStep === 2">
            <component :form="form" :is="roleComponent"></component>
        </div>
        <div
            v-if="roleComponent == 'app-teacher-step'"
            class="mt-2 px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-between items-center"
        >
            <button
                class=" inline px-4 py-2 cursor-pointer rounded-md"
                :class="
                    formStep <= 1
                        ? 'bg-indigo-200 text-gray-200 cursor-not-allowed'
                        : 'bg-indigo-500 text-white'
                "
                :disabled="formStep <= 1"
                @click.prevent="formStep--"
            >
                <i class="fa fa-chevron-left" aria-hidden="true"></i> Go Back
            </button>
            <button
                class=" inline px-4 py-2 cursor-pointer rounded-md"
                :class="
                    formStep >= 2 || !form.role
                        ? 'bg-indigo-200 text-gray-200 cursor-not-allowed'
                        : 'bg-indigo-500 text-white'
                "
                :disabled="formStep >= 2 || !form.role"
                @click.prevent="formStep++"
            >
                Add Details
                <i class="fa fa-chevron-right" aria-hidden="true"></i>
            </button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            formStep: 1
        };
    },
    props: {
        form: {
            required: true,
            type: Object
        }
    },
    methods: {
        store() {
            this.form.post(this.route("admin.users.create"));
        }
    },
    computed: {
        roleComponent() {
            return this.form.role === "student"
                ? "app-student-step"
                : this.form.role === "teacher"
                ? "app-teacher-step"
                : "app-admin-step";
        }
    }
};
</script>
