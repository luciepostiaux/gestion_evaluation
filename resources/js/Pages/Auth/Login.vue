<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import AuthenticationCard from "@/Components/AuthenticationCard.vue";
import AuthenticationCardLogo from "@/Components/AuthenticationCardLogo.vue";
import Checkbox from "@/Components/Checkbox.vue";
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import ApplicationMark from "@/Components/ApplicationMark.vue";

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
  form
    .transform((data) => ({
      ...data,
      remember: form.remember ? "on" : "",
    }))
    .post(route("login"), {
      onFinish: () => form.reset("password"),
    });
};
</script>

<template>
  <Head title="Log in" />

  <AuthenticationCard>
    <template #logo> </template>

    <div v-if="status" class="font-medium mb-4 text-sm text-green-600">
      {{ status }}
    </div>

    <form @submit.prevent="submit">
      <ApplicationMark
        class="block h-full w-auto p-8 mb-8 border-b-2 border-[#1F2D55]"
      />
      <p class="text-center subpixel-antialiased font-bold text-xl mb-4">
        Evaluation des élèves
      </p>
      <div>
        <InputLabel for="email" value="Email" />
        <TextInput
          id="email"
          v-model="form.email"
          type="email"
          class="mt-1 block w-full"
          required
          autofocus
          autocomplete="username"
        />
        <InputError class="mt-2" :message="form.errors.email" />
      </div>

      <div class="mt-4">
        <InputLabel for="password" value="Mot de passe" />
        <TextInput
          id="password"
          v-model="form.password"
          type="password"
          class="mt-1 block w-full"
          required
          autocomplete="current-password"
        />
        <InputError class="mt-2" :message="form.errors.password" />
      </div>

      <div class="block mt-4">
        <label class="flex items-center">
          <Checkbox v-model:checked="form.remember" name="remember" />
          <span class="ms-2 text-sm text-gray-600">Se souvenir de moi</span>
        </label>
      </div>

      <div class="flex items-center justify-end mt-4">
        <SecondaryButton
          v-if="canResetPassword"
          :href="route('password.request')"
          class="underline text-sm"
        >
          Mot de passe oublié?
        </SecondaryButton>

        <PrimaryButton
          class="ms-4"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Connexion
        </PrimaryButton>
      </div>

      <div class="py-4 text">
        <p class="">
          Vous n'avez pas de compte ?
          <Link :href="route('register')"> Enregistrez-vous </Link>
        </p>
      </div>
    </form>
  </AuthenticationCard>
</template>
