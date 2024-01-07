<script setup>
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import CartIcon from "@/Components/icons/CartIcon.vue";
import PrimaryButton from "@/Components/common/PrimaryButton.vue";
import NumberControl from "@/Components/NumberControl.vue";

const props = defineProps({
    product: Object,
    quantity: Number,
});

const productImage = () => {
    let preview = props.product.images.find(image => {
        return image.is_preview;
    });

    return '/images/' + preview.url;
}

const processing = ref(false);

const addToCart = () => {
    Inertia.post(route("cart.store", { id: props.product.id }), [], {
        onStart: () => { processing.value = true; },
        onFinish: () => { processing.value = false; }
    });
};
</script>

<template>
    <div class="flex flex-col items-center justify-center relative border rounded-lg overflow-hidden">
        <div class="w-full h-48">
            <Link :href="route('product.show', { slug: product.slug })">
                <img :src="productImage()" alt="product_image" class="w-full h-full object-cover">
            </Link>
        </div>

        <div class="w-full p-2 pt-6 pb-4">
            <div class="flex items-start justify-between space-x-4">
                <div>
                    <span class="block font-medium leading-4 truncate">{{ product.name }}</span>
                </div>
            </div>
            <span class="whitespace-nowrap"><span class="font-medium">€</span>{{ product.price }}</span>
            <div class="text-xs text-zinc-500 mt-2 mb-4 truncate">{{ product.description }}</div>

            <NumberControl v-if="quantity > 0" :product="product" :quantity="quantity" />

            <form v-else @submit.prevent="addToCart()">
                <PrimaryButton :loading="processing">
                    <CartIcon v-if="!processing" />
                    <span class="uppercase ml-2" v-if="!processing">Add to cart</span>
                </PrimaryButton>
            </form>
        </div>
    </div>
</template>
