<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/common/InputError.vue";
import InputLabel from "@/Components/common/InputLabel.vue";
import TextInput from "@/Components/common/TextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import PrimaryButton from "@/Components/common/PrimaryButton.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-indigo-500">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <header>
                <h2 class="font-medium uppercase text-3xl text-center py-4">Log in</h2>
            </header>
            <div>
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full placeholder-zinc-400"
                    placeholder="Enter your email"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-5">
                <InputLabel for="password" value="Password" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full placeholder-zinc-400"
                    placeholder="Enter your password"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-6">
                <PrimaryButton :loading="form.processing">Login</PrimaryButton>
            </div>
            <div class="text-sm text-zinc-500 mt-4 mb-2 flex items-center justify-center">
                <Link
                    href="register"
                    class="text-indigo-500"
                >Register now</Link>
            </div>
        </form>
    </GuestLayout>
</template>
