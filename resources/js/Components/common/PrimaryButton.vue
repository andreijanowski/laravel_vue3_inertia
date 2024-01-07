<script setup>
import LoadingIcon from "../icons/LoadingIcon.vue";

defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    loading: {
        type: Boolean,
        default: false
    }
});
</script>

<template>
    <button
        :type="type"
        :disabled="loading"
        :class="loading ? 'bg-indigo-300' : 'bg-indigo-500 hover:bg-indigo-300'"
        class="text-white text-sm w-full py-3 rounded transition flex justify-center px-4 min-w-40">
        <slot v-if="!loading" />
        <LoadingIcon v-else />
    </button>
</template>
