<script setup>
import { onMounted, reactive, ref } from "vue";
import { vMaska } from "maska";

const props = defineProps({
    error: String,
    label: String,
    modelValue: {
        type: [String, Number],
        default: ""
    }
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

const bindedObject = reactive({});
</script>
<template>
    <div class="pr-6 pb-8 w-full lg:w-1/2" :class="$attrs.class">
        <label v-if="label" class="form-label">{{ label }}:</label>
        <input
            v-bind="{ ...$attrs, class: null }"
            class="form-input"
            :class="{ error: error }"
            v-maska="bindedObject"
            :value="modelValue"
            @input="$emit('update:modelValue', bindedObject.unmasked)"
            ref="input"
            data-maska="#####-#######-#"
        />
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<style scoped>
/* Chrome, Safari, Edge, Opera */
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Firefox */
input[type="number"] {
    -moz-appearance: textfield;
}

.form-input {
    @apply p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring;
}

.form-input.error {
    @apply border-red-500 focus:ring focus:ring-red-200;
}

.form-error {
    @apply text-red-700 mt-2 text-sm;
}
</style>
