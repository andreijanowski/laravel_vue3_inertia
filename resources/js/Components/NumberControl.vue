<script setup>
import { Inertia } from "@inertiajs/inertia";
import MinusIcon from "@/Components/icons/MinusIcon.vue";
import PlusIcon from "@/Components/icons/PlusIcon.vue";
import { ref } from "vue";

const props = defineProps({
    product: Object,
    quantity: Number,
});

const processing = ref(false);

const increase = (id) => {
    Inertia.patch(route("cart.increase", { id: id }), [], {
        onStart: () => { processing.value = true; },
        onFinish: () => { processing.value = false; },
    });
};

const decrease = (id) => {
    Inertia.patch(route("cart.decrease", { id: id }), [], {
        onStart: () => { processing.value = true; },
        onFinish: () => { processing.value = false; },
    });
};

const removeItem = (id) => {
    Inertia.delete(route("cart.destroy", { id: id }));
};
</script>

<template>
    <div class="grid grid-cols-2 gap-4">
        <div class="flex flex-col text-white sm:flex-row justify-center py-2 h-11 items-center sm:space-x-2 sm:space-y-0 space-y-1 bg-indigo-500 rounded">
            <form @submit.prevent="decrease(product.id)">
                <button
                    type="submit"
                    :disabled="processing"
                    class="w-6 h-6 rounded flex items-center justify-center transition"
                >
                    <MinusIcon class="w-5 h-5" />
                </button>
            </form>
            <span class="font-medium text-white">{{ quantity }}</span>
            <form @submit.prevent="increase(product.id)">
                <button
                    type="submit"
                    :disabled="processing"
                    class="w-6 h-6 rounded flex items-center justify-center transition"
                >
                    <PlusIcon class="w-5 h-5" />
                </button>
            </form>
        </div>
        <div>
            <form @submit.prevent="removeItem(product.id)">
                <button class="bg-red-400 hover:bg-red-500 px-4 text-white rounded text-sm w-full h-11 py-2">Remove</button>
            </form>
        </div>
    </div>
</template>
