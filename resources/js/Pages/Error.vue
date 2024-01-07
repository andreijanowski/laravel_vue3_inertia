<script setup>
import MainLayout from '@/Layouts/MainLayout.vue';

const props = defineProps({
    code: Number,
    message: String
});
</script>

<template>
    <MainLayout>
        <Head title="Error" />

        <div class="max-w-sm mx-auto">
            <div class="bg-red-200 p-2 rounded mt-10">
                <p class="text-red-500 text-sm">{{ code }} | {{ message }}</p>
            </div>
        </div>
    </MainLayout>
</template>
