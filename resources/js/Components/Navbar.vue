<script setup>
import UserMenu from "@/Components/UserMenu.vue";
</script>

<template>
    <div>
        <nav class="bg-white shadow-lg border-b border-zinc-200">
            <div class="max-w-7xl mx-auto px-6 py-4">
                <div class="flex justify-between">
                    <div class="flex gap-4 items-center">
                        <h1 class="font-medium text-2xl mr-20">
                            <Link :href="route('shop')">Online Shop</Link>
                        </h1>
                        <Link
                            class="block border-l-4 pl-6 py-2 border-transparent "
                            :class="route().current('shop') ? 'text-indigo-500 font-semibold' : ''"
                            :href="route('shop')"
                        >
                            <span>Products</span>
                        </Link>
                        <Link
                            class="block border-l-4 pl-6 py-2 border-transparent relative"
                            :class="route().current('cart.index') ? 'text-indigo-500 font-semibold' : ''"
                            :href="route('cart.index')"
                        >
                            <span>Cart</span>
                            <div
                                v-if="$page.props.auth.user && $page.props.cart.length > 0"
                                class="absolute top-1 -right-5 w-4 h-4 bg-indigo-500 text-white flex items-center justify-center text-xxs rounded-full">
                                    {{ $page.props.cart.length }}
                            </div>
                        </Link>
                    </div>
                    <div class="flex items-center gap-2">
                        <div>{{ $page.props.auth.user.name }}</div>
                        <UserMenu class="mr-1" :user="$page.props.auth.user" />
                    </div>
                </div>
            </div>
        </nav>
    </div>
</template>
