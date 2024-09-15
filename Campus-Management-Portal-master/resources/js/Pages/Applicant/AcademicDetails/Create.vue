<script setup>
import TheApplicantHead from "../../../components/applicant/meta/TheApplicantHead.vue";
import SelectTypeStep from "./Partials/SelectTypeStep.vue";
import SelectQualificationStep from "./Partials/SelectQualificationStep.vue";
import SelectExamStep from "./Partials/SelectExamStep.vue";

import IconArrowLeft from "~icons/mdi/arrow-left";
import IconArrowRight from "~icons/mdi/arrow-right";
import { ref } from "vue";
import { useAcademicDetailsForm } from "@/stores/academicDetailsForm";

const props = defineProps({
    organizations: {
        type: Array,
        required: true
    },
    degreeTypes: {
        type: Object,
        required: true
    }
});

const academicDetailsForm = useAcademicDetailsForm();

const form = academicDetailsForm.form;

const animateShake = ref(false);

const callToAction = () => {
    animateShake.value = true;
    setTimeout(resetAnimation, 1000);
};

const resetAnimation = () => {
    animateShake.value = false;
};

const store = () => {
    form.post(route("applicant.academic-details.store"), {
        preserveState: false,
        onSuccess: () => academicDetailsForm.$reset()
    });
};
</script>
<template>
    <div class="flex flex-col gap-8">
        <TheApplicantHead title="Add Academic details" />
        <div class="h-fit">
            <transition-group :name="`slide-${academicDetailsForm.transition}`">
                <SelectTypeStep
                    :key="academicDetailsForm.currentStep"
                    v-if="academicDetailsForm.currentStep === 1"
                    :degreeTypes="degreeTypes"
                    :animateShake="animateShake"
                />
                <SelectQualificationStep
                    v-if="academicDetailsForm.currentStep === 2"
                    :key="academicDetailsForm.currentStep"
                    class="form"
                    :organizations="organizations"
                    :degreeTypes="degreeTypes"
                />
                <SelectExamStep
                    v-if="academicDetailsForm.currentStep === 3"
                    :key="academicDetailsForm.currentStep"
                    class="form"
                />
            </transition-group>
        </div>

        <div class="mt-4 flex justify-between max-w-3xl">
            <button
                class="btn-main "
                v-if="!academicDetailsForm.isFirstStep"
                @click="academicDetailsForm.previousStep()"
            >
                <span class="flex gap-2 items-center">
                    <IconArrowLeft size="18" />
                    Back
                </span>
            </button>
            <button
                class="btn-main ml-auto flex gap-2"
                v-if="!academicDetailsForm.isLastStep"
                @click="
                    () => {
                        if (!form.type) {
                            callToAction();
                            return;
                        }
                        academicDetailsForm.nextStep();
                    }
                "
            >
                <span class="flex gap-2 items-center">
                    Next
                    <IconArrowRight size="18" />
                </span>
            </button>
            <button
                class="btn-main ml-auto flex gap-2"
                v-if="academicDetailsForm.isLastStep"
                @click.prevent="store"
            >
                <span class="flex gap-2 items-center">
                    Add
                </span>
            </button>
        </div>
    </div>
</template>

<style scoped>
.slide-next-leave-active,
.slide-previous-leave-active {
    transition: all 800ms ease-out;
}

.slide-next-enter-active,
.slide-previous-enter-active {
    transition: all 800ms ease-out 700ms;
}

.slide-next-enter-from,
.slide-previous-leave-to {
    transform: translate(-200%, 0);
}

.slide-next-leave-to,
.slide-previous-enter-from {
    transform: translate(-200%, 0);
}

.form {
    @apply bg-white rounded-md shadow max-w-3xl;
}
</style>
