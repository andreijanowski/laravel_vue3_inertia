<script setup>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import { ref } from "vue";

const props = defineProps({
    user: Object,
});

const showUserMenu = ref(false);

const toggleUserMenu = () => {
    if (!props.user) {
        Inertia.get(route('login'));
    }

    showUserMenu.value = !showUserMenu.value;
};

const logout = () => {
    showUserMenu.value = false;

    Inertia.post(route('logout'))
}
</script>

<template>
    <div>
        <div class="relative">
            <div
                @click="toggleUserMenu()"
                :class="{ 'bg-zinc-200' : showUserMenu }"
                class="hover:bg-zinc-200 p-2 rounded-full transition cursor-pointer">
                    <svg class="w-[19px] h-[19px] text-zinc-600 flex-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
            </div>

            <transition name="fade">
                <div
                    v-if="showUserMenu && user"
                    class="absolute mt-2 right-0 bg-white w-44 max-h-max text-[13px] shadow-md z-30 rounded-xl"
                >
                    <div class="m-2">
                        <form @submit.prevent="logout()">
                            <button
                                type="submit"
                                class="w-full flex items-center space-x-2 p-2 hover:bg-zinc-200 rounded transition">
                                    <svg class="w-[18px] h-[18px] flex-none text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </transition>
        </div>

        <div
            v-if="showUserMenu && user"
            class="bg-black fixed inset-0 opacity-10 z-20"
            @click="toggleUserMenu()"
        ></div>
    </div>
</template>
