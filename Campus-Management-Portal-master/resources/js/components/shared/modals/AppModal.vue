<script setup>
const props = defineProps({
    modalWidth: {
        required: false
    }
});

defineEmits(["close"]);
</script>
<template>
    <transition
        enter-active-class="transition ease-out duration-200 transform"
        enter-from-class="opacity-0"
        enter-to-class="opacity-100"
        leave-active-class="transition ease-in duration-200 transform"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            class="fixed inset-0 overflow-y-auto bg-black bg-opacity-50 z-50 w-screen"
        >
            <div
                @click.self="$emit('close')"
                id="overlay"
                class="flex items-start justify-center min-h-screen pt-10 text-center"
            >
                <transition
                    enter-active-class="transition ease-out duration-300 transform "
                    enter-from-class="opacity-0 translate-y-10 scale-95"
                    enter-to-class="opacity-100 translate-y-0 scale-100"
                    leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 scale-100"
                    leave-to-class="opacity-0 translate-y-10 translate-y-0 scale-95"
                >
                    <div
                        :class="modalWidth"
                        class="bg-white rounded-lg text-left overflow-hidden shadow-xl p-8 relative"
                    >
                        <div
                            @click="$emit('close')"
                            id="btn-close"
                            class="absolute right-4 top-4 text-4xl z-20 text-red-500 cursor-pointer"
                        >
                            <i class="fas fa-times-circle"></i>
                        </div>
                        <div>
                            <slot></slot>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </transition>
</template>
