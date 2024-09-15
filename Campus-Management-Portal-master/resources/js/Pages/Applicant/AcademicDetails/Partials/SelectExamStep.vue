<script setup>
import { computed } from "vue";
import FormInputSelect from "../../../../components/shared/form/FormInputSelect.vue";
import FormInputText from "../../../../components/shared/form/FormInputText.vue";
import { useAcademicDetailsForm } from "@/stores/academicDetailsForm";
import FormInputImage from "../../../../components/shared/form/FormInputImage.vue";
import AppImagePreview from "../../../../components/shared/ui/AppImagePreview.vue";

const form = useAcademicDetailsForm().form;

const props = defineProps({
    modelValue: {
        required: true
    }
});

const emits = defineEmits(["update:modelValue"]);

const percentage = computed(() => {
    return ((form.obtained_marks / form.total_marks) * 100).toFixed(2);
});

const handleSelectedMedia = files => {
    form.image = files;
};
</script>
<template>
    <div>
        <h2 class="p-6 pb-0 text-xl font-semibold">
            Result Information
        </h2>
        <AppImagePreview class="mx-auto max-w-lg mt-4" :src="form.image" />
        <div class="form-row">
            <FormInputSelect
                label="Exam Type"
                v-model="form.exam_type"
                :error="form.errors.exam_type"
            >
                <option value=""></option>
                <option value="annual-1st">Annual 1st</option>
                <option value="annual-2nd">Annual 2nd</option>
                <option value="supplementary">Supplementary</option>
            </FormInputSelect>
            <FormInputText
                label="Registeration/Roll Number"
                v-model="form.reg_no"
                :error="form.errors.reg_no"
            />
        </div>
        <div class="form-row">
            <FormInputImage
                label="Upload result card"
                @selected="handleSelectedMedia"
                :error="form.errors.image"
            />
        </div>
        <div class="form-row form-row-full">
            <FormInputText
                type="number"
                min="1900"
                max="2099"
                step="1"
                v-model="form.passing_year"
                label="Passing Year"
                :error="form.errors.passing_year"
            />
            <FormInputText
                label="Total Marks"
                v-model="form.total_marks"
                :error="form.errors.total_marks"
            />
            <FormInputText
                label="Obtained Marks"
                v-model="form.obtained_marks"
                :error="form.errors.obtained_marks"
            />
        </div>
        <div v-if="form.total_marks && form.obtained_marks" class="form-row">
            <label class="form-label ">Percentage: {{ percentage }}%</label>
        </div>
    </div>
</template>

<style scoped>
.form-row-full {
    @apply flex-nowrap;
}
</style>
