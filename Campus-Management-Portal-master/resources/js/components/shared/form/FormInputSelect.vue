<script setup>
import { onMounted, ref } from "vue";

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
</script>

<template>
    <div class="pr-6 pb-8 w-full lg:w-1/2" :class="$attrs.class">
        <label v-if="label" class="form-label">{{ label }}:</label>
        <select
            v-bind="{ ...$attrs, class: null }"
            class="form-select p-2 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-gray-400"
            :class="{ 'focus:ring focus:ring-red-200': error }"
            :value="modelValue"
            @change="$emit('update:modelValue', $event.target.value)"
            ref="input"
        >
            <slot />
        </select>
        <div v-if="error" class="form-error">{{ error }}</div>
    </div>
</template>

<style scoped>
.form-select {
    @apply p-2 pr-6 leading-normal block w-full border text-gray-700 bg-white font-sans rounded text-left appearance-none relative focus:border-indigo-400 focus:ring;
    background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAQCAYAAAAMJL+VAAAABGdBTUEAALGPC/xhBQAAAQtJREFUOBG1lEEOgjAQRalbGj2OG9caOACn4ALGtfEuHACiazceR1PWOH/CNA3aMiTaBDpt/7zPdBKy7M/DCL9pGkvxxVp7KsvyJftL5rZt1865M+Ucq6pyyF3hNcI7Cuu+728QYn/JQA5yKaempxuZmQngOwEaYx55nu+1lQh8GIatMGi+01NwBcEmhxBqK4nAPZJ78K0KKFAJmR3oPp8+Iwgob0Oa6+TLoeCvRx+mTUYf/FVBGTPRwDkfLxnaSrRwcH0FWhNOmrkWYbE2XEicqgSa1J0LQ+aPCuQgZiLnwewbGuz5MGoAhcIkCQcjaTBjMgtXGURMVHC1wcQEy0J+Zlj8bKAnY1/UzDe2dbAVqfXn6wAAAABJRU5ErkJggg==");
    background-size: 0.7rem;
    background-repeat: no-repeat;
    background-position: right 0.7rem center;
}

.form-select.error {
    @apply border-red-500 focus:ring focus:ring-red-200;
}

.form-error {
    @apply text-red-700 mt-2 text-sm;
}
</style>
