<script setup>
import FormInputSelect from "@/components/shared/form/FormInputSelect.vue";

import { useAcademicDetailsForm } from "@/stores/academicDetailsForm";

const form = useAcademicDetailsForm().form;
const props = defineProps({
    organizations: {
        required: true
    },
    degreeTypes: {
        required: true
    }
});
</script>

<template>
    <div>
        <h2 class="p-6 pb-0 text-xl font-semibold">
            Qualification Information
        </h2>
        <div class="form-row">
            <FormInputSelect
                label="Organization"
                :error="form.errors.organization_id"
                v-model="form.organization_id"
            >
                <option
                    v-for="organization in organizations"
                    :key="organization.id"
                    :value="organization.id"
                    >{{ organization.organization_name }}</option
                >
            </FormInputSelect>
            <FormInputSelect
                label="Qualification Title"
                :error="form.errors.title"
                v-if="form.type"
                v-model="form.title"
            >
                <option value=""></option>
                <option
                    v-for="(title, index) in degreeTypes[form.type]"
                    class="capitalize"
                    :key="index"
                    :value="title"
                >
                    {{ title }}
                </option>
            </FormInputSelect>
        </div>
    </div>
</template>
