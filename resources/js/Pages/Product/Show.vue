<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { ref } from "vue";
import CartIcon from "@/Components/icons/CartIcon.vue";
import PrimaryButton from "@/Components/common/PrimaryButton.vue";
import NumberControl from "@/Components/NumberControl.vue";

const props = defineProps({
    product: Object,
    cart: Object
});

const processing = ref(false);

const addToCart = () => {
    Inertia.post(route("cart.store", { id: props.product.id }), [], {
        onStart: () => { processing.value = true; },
        onFinish: () => { processing.value = false; }
    });
};


const productImage = () => {
    let preview = props.product.images.find(image => {
        return image.is_preview;
    });

    return '/images/' + preview.url;
}

</script>

<template>
    <MainLayout>
        <Head :title="product.name" />

        <div class="max-w-7xl mx-auto sm:flex sm:space-x-8 mt-8">
            <div class="w-full sm:w-1/2 h-96 flex-none">
                <img :src="productImage()" alt="product_image" class="w-full h-full object-cover">
            </div>

            <div class="mt-6 sm:mt-0">
                <h3 class="text-2xl font-medium mb-1">{{ product.name }}</h3>

                <p class="text-base mb-2"><span class="font-medium">€</span>{{ product.price }}</p>
                <span class="block text-zinc-500 text-sm mb-4">{{ product.description }}</span>

                <p class="text-xs text-zinc-500 mb-8">{{ product.description }}</p>

                <div class="flex items-start">
                    <div v-if="($page.props.cart.find((el) => el.id === product?.id)?.pivot?.quantity || 0) > 0" class="w-80">
                        <NumberControl :product="product" :quantity="$page.props.cart.find((el) => el.id === product?.id)?.pivot?.quantity || 0" />
                    </div>
                    <form v-else @submit.prevent="addToCart()">
                        <PrimaryButton :loading="processing">
                            <CartIcon v-if="!processing" />
                            <span class="uppercase ml-2" v-if="!processing">Add to cart</span>
                        </PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
