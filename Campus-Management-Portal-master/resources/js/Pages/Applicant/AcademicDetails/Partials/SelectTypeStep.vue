<script setup>
import { computed } from "vue";
import { useAcademicDetailsForm } from "@/stores/academicDetailsForm";

const form = useAcademicDetailsForm().form;

const props = defineProps({
    degreeTypes: {
        required: true
    },
    animateShake: { default: false }
});

const animateShakeClass = computed(() => {
    return props.animateShake ? "animateshake" : "";
});
</script>

<template>
    <div>
        <h1 class="text-center">Select your qualification type</h1>
        <div
            class="flex flex-col justify-center gap-16 mt-8 mx-auto w-max sm:flex-row"
        >
            <div
                v-for="(degreeType, index) in degreeTypes"
                :key="index"
                class="tile bg-white shadow-lg rounded-lg"
                :class="[
                    animateShakeClass,
                    form.type === index ? 'tile--selected' : ''
                ]"
            >
                <label
                    class="w-44 h-44 cursor-pointer text-2xl capitalize flex justify-center items-center"
                    :for="index"
                    >{{ index }}</label
                >
                <input
                    class="hidden"
                    :value="index"
                    v-model="form.type"
                    name="types"
                    type="radio"
                    :id="index"
                />
            </div>
        </div>
    </div>
</template>

<style scoped>
.animateshake {
    animation: shakeanimation 0.82s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
    transform: translate3d(0, 0, 0);
}

.tile--selected {
    @apply opacity-100 bg-indigo-500 text-white shadow-2xl;
}
</style>
