<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import InputError from "@/Components/common/InputError.vue";
import InputLabel from "@/Components/common/InputLabel.vue";
import TextInput from "@/Components/common/TextInput.vue";
import PrimaryButton from "@/Components/common/PrimaryButton.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
    terms: false,
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <header>
            <h2 class="font-medium uppercase text-3xl text-center py-4">Register</h2>
            <p class="text-center text-sm text-zinc-500 mb-6">
                Already registered?
                <Link
                    :href="route('login')"
                    class="text-indigo-500">Log in</Link>
            </p>
        </header>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full placeholder-zinc-400"
                    placeholder="Enter your name"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-5">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full placeholder-zinc-400"
                    placeholder="Example@mail.com"
                    v-model="form.email"
                    required
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
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-5">
                <InputLabel
                    for="password_confirmation"
                    value="Confirm Password"
                />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full placeholder-zinc-400"
                    placeholder="Confirm your password"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex items-center justify-end mt-6">
                <PrimaryButton :loading="form.processing">Register</PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
