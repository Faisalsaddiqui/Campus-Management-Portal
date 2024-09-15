<script setup>
import { ref } from "vue";

const props = defineProps({
    modelValue: {
        type: [Boolean],
        default: false
    }
});

defineEmits(["update:modelValue"]);

defineOptions({
    inheritAttrs: false
});

const input = ref(null);
</script>

<template>
    <div class="flex w-full mb-12">
        <label :for="$attrs.id" class="flex items-center cursor-pointer">
            <div class="relative">
                <input
                    :checked="modelValue"
                    type="checkbox"
                    :id="$attrs.id"
                    @change="$emit('update:modelValue', $event.target.checked)"
                    ref="input"
                    class="sr-only"
                />
                <div class="block bg-gray-600 w-14 h-8 rounded-full"></div>
                <div
                    class="dot absolute left-1 top-1 bg-white w-6 h-6 rounded-full transition"
                ></div>
            </div>
        </label>
    </div>
</template>

<style scoped>
input:checked ~ .dot {
    transform: translateX(100%);
    background-color: #48bb78;
}
</style>
