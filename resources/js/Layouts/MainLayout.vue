<script setup>
import Navbar from "@/Components/Navbar.vue";
import ErrorMessage from '@/Components/ErrorMessage.vue'
</script>

<template>
    <div>
        <div class="min-h-screen bg-white">
            <Navbar />

            <transition name="list">
                <ErrorMessage v-if="$page.props.flash.error"></ErrorMessage>
            </transition>

            <!-- Page Content -->
            <main class="max-w-7xl mx-auto px-6">
                <slot />
            </main>
        </div>
    </div>
</template>
