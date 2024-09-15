<script setup>
const props = defineProps({
    label: {
        type: String,
        required: false
    },
    error: String
});

const emit = defineEmits(["selected"]);

const allowedMediaTypes = [
    "image/jpg",
    "image/jpeg",
    "image/png",
    "image/webp"
];

const handleSelectedMedia = event => {
    Array.from(event.target.files).forEach(file => {
        if (allowedMediaTypes.includes(file.type)) {
            emit("selected", file);
        } else {
            props.error = "Invalid File type";
        }
    });
};
</script>

<template>
    <div class="pr-6 pb-8 w-full">
        <label v-if="label" class="form-label ">{{ label }}:</label>
        <input
            v-bind="{ ...$attrs, class: null }"
            type="file"
            @change="handleSelectedMedia"
            class="p-2 leading-normal block w-full border border-gray-600  bg-gray-700 text-white font-sans rounded text-left appearance-none relative focus:border-gray-400 "
            :class="{ 'focus:ring focus:ring-red-200': error }"
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

.form-input.error {
    @apply border-red-500;
}

.form-error {
    @apply text-red-700 mt-2 text-sm;
}
</style>
