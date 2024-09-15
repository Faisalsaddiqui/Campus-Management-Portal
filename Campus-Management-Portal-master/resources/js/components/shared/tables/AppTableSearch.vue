<script setup>
import AppDropdown from "@/components/shared/ui/AppDropdown.vue";

const props = defineProps({
    modelValue: {
        required: false
    },
    filterable: {
        type: Boolean,
        default: false
    }
});

defineEmits(["update:modelValue", "reset"]);
</script>
<template>
    <div class="flex items-center">
        <div class="flex w-screen bg-white shadow rounded">
            <AppDropdown
                v-if="filterable"
                :closeOnClick="false"
                align="bottom-center"
                class="rounded-l border-r hover:bg-gray-100 focus:border-white focus:ring focus:z-10 flex items-center"
                :contentClasses="['w-screen', 'max-w-xs']"
            >
                <template v-slot:trigger>
                    <div class="flex py-2 px-4 items-center h-full w-full">
                        <span class="text-gray-700 hidden md:inline"
                            >Filter</span
                        >
                        <svg
                            class="w-2 h-2 fill-gray-700 md:ml-2"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 961.243 599.998"
                        >
                            <path
                                d="M239.998 239.999L0 0h961.243L721.246 240c-131.999 132-240.28 240-240.624 239.999-.345-.001-108.625-108.001-240.624-240z"
                            />
                        </svg>
                    </div>
                </template>
                <template v-slot:content>
                    <div
                        slot="dropdown"
                        class="mt-2 px-4 py-6 shadow-xl bg-white rounded "
                    >
                        <slot />
                    </div>
                </template>
            </AppDropdown>
            <input
                class="relative w-full px-6 py-3 rounded-r focus:ring"
                autocomplete="off"
                type="text"
                name="search"
                placeholder="Search…"
                @input="$emit('update:modelValue', $event.target.value)"
                :value="modelValue"
            />
        </div>
        <button
            class="ml-3 text-sm text-gray-500 hover:text-gray-700 focus:text-indigo-500"
            type="button"
            @click="$emit('reset')"
        >
            Reset
        </button>
    </div>
</template>
