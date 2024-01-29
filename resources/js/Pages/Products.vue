<script setup>
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductCard from "@/Components/ProductCard.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    products: Object,
    cartProducts: Object,
});

</script>

<template>
    <MainLayout>
        <Head title="Products" />

        <div class="sm:flex">
            <div class="flex-1 relative pt-8">

                <header class="flex items-center justify-between mb-10">
                    <h2 class="text-4xl font-medium">Products</h2>
                </header>

                <div>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <ProductCard
                            v-for="product in products.data"
                            :key="product.id"
                            :product="product"
                            :quantity="cartProducts?.find((el) => el.id === product.id)?.pivot?.quantity || 0"
                        ></ProductCard>
                    </div>

                    <Pagination
                        v-if="products.links.next || products.links.prev"
                        :links="products.meta.links"
                        :meta="products.links"
                    ></Pagination>
                </div>
            </div>
        </div>
    </MainLayout>
</template>
