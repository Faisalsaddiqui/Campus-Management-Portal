import { useForm } from "@inertiajs/vue3";
import { defineStore } from "pinia";
import { computed, ref } from "vue";

export const useAcademicDetailsForm = defineStore('academicDetailsForm', () => {

  const currentStep = ref(1);
  const transition = ref("previous");

  const form = useForm({
    type: "",
    organization_id: "",
    title: "",
    exam_type: "",
    reg_no: "",
    passing_year: "",
    obtained_marks: "",
    total_marks: "",
    image: ""
  });

  const isFirstStep = computed(() => {
    return currentStep.value === 1;
  });

  const isLastStep = computed(() => {
    return currentStep.value === 3;
  });

  const nextStep = () => {
    if (!isLastStep.value) {
      transition.value = "next";
      currentStep.value++;
    }
  };
  const previousStep = () => {
    if (!isFirstStep.value) {
      transition.value = "previous";
      currentStep.value--;
    }
  };

  const $reset = () => {
    form.reset()
    currentStep.value = 1
    transition.value = "previous"
  }
  return { form, isFirstStep, isLastStep, nextStep, previousStep, currentStep, transition, $reset }
})
