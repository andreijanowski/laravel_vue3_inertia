<script setup>
import { ref } from 'vue';
import MainLayout from "@/Layouts/MainLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import MinusIcon from '@/Components/icons/MinusIcon.vue';
import PlusIcon from '@/Components/icons/PlusIcon.vue';

const props = defineProps({
    products: Array,
    total: String|Number,
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

const emptyCart = () => {
    Inertia.delete(route("cart.empty"));
};

const total = () => {
    return props.total;
};

const productImage = (product) => {
    let preview = product.images.find(image => {
        return image.is_preview;
    });

    return '/images/' + preview.url;
}
</script>

<template>
    <MainLayout>
        <Head title="Cart" />

        <div class="max-w-7xl mx-auto">
            <header class="py-6 border-b border-zinc-200">
                <h2 class="text-2xl font-medium">Cart</h2>
                <div class="flex items-center justify-between">
                    <span
                        v-if="products.length > 0"
                        class="text-zinc-500 text-sm">You have {{ products.length }} {{ products.length === 1 ? "product" : "products" }} in your cart</span>

                    <p v-else class="text-zinc-500 text-sm">Your cart is empty. <Link :href="route('shop')" class="text-indigo-500">Go to products</Link></p>

                    <form @submit.prevent="emptyCart()" v-if="products.length > 0">
                        <button
                            type="submit"
                            class="bg-red-400 hover:bg-red-500 px-4 text-white hover:underline rounded text-sm py-1.5 mt-4"
                        >
                            Empty cart
                        </button>
                    </form>
                </div>
            </header>

            <section v-if="products.length > 0">
                <table class="w-full my-5">
                    <tr class="">
                        <th class="text-left font-normal uppercase text-xxs text-zinc-400 pb-6">
                            Product details
                        </th>
                        <th class="text-left font-normal uppercase text-xxs text-zinc-400 pb-6">
                            Quantity
                        </th>
                        <th class="text-left font-normal uppercase text-xxs text-zinc-400 pb-6">
                            Price
                        </th>
                        <th class="text-left font-normal uppercase text-xxs text-zinc-400 pb-6 hidden sm:block">
                            Total
                        </th>
                    </tr>

                    <tr v-for="product in products" :key="product.id">
                        <td>
                            <div class="flex items-start space-x-4 mb-6">
                                <Link :href="route('product.show', { slug: product.slug })" class="w-20 h-24">
                                    <img :src="productImage(product)" alt="product_image" class="w-full h-full object-cover">
                                </Link>

                                <div class="flex flex-col justify-around">
                                    <span class="text-sm font-medium">{{ product.name }}</span>

                                    <div class="flex items-center space-x-2">
                                        <form @submit.prevent="removeItem(product.id)">
                                            <button
                                                type="submit"
                                                class="bg-red-400 hover:bg-red-500 px-4 text-white hover:underline rounded text-sm py-1.5 mt-4"
                                            >
                                                Remove
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-sm align-top">
                            <div class="flex flex-col sm:flex-row items-center sm:space-x-2 sm:space-y-0 space-y-1 ">
                                <form @submit.prevent="decrease(product.id)">
                                    <button
                                        type="submit"
                                        :disabled="processing"
                                        :class="processing ? 'bg-zinc-300' : 'bg-zinc-300 hover:bg-indigo-500 hover:text-white'"
                                        class="w-6 h-6 rounded flex items-center justify-center transition"
                                    >
                                        <MinusIcon class="w-4 h-4" />
                                    </button>
                                </form>
                                <span class="font-medium">{{ product.pivot.quantity }}</span>
                                <form @submit.prevent="increase(product.id)">
                                    <button
                                        type="submit"
                                        :disabled="processing"
                                        :class="processing ? 'bg-zinc-300' : 'bg-zinc-300 hover:bg-indigo-500 hover:text-white'"
                                        class="w-6 h-6 rounded flex items-center justify-center transition"
                                    >
                                        <PlusIcon class="w-4 h-4" />
                                    </button>
                                </form>
                            </div>
                        </td>
                        <td class="text-sm align-top">
                            <span class="text-sm"><span class="font-medium">€</span>{{ product.price }}</span>
                        </td>
                        <td class="text-sm align-top hidden sm:block">
                            <span class="text-sm"><span class="font-medium">€</span>{{ (product.pivot.quantity * product.price).toFixed(2) }}</span>
                        </td>
                    </tr>
                </table>

                <footer class="flex justify-end py-6 border-t border-zinc-200">
                    <div class="space-y-3 w-1/3">
                        <div class="flex items-center justify-between">
                            <span class="text-zinc-500 uppercase text-xs">Total</span>
                            <span class="text-sm"><span class="font-medium">€</span>{{ total() }}</span>
                        </div>
                    </div>
                </footer>
            </section>
        </div>
    </MainLayout>
</template>
