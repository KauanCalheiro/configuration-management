<script setup lang="ts">
import type { FormSubmitEvent } from "#ui/types";
import * as yup from "yup";
import type ApiResponse from "~~/types/ApiResponse";

definePageMeta({
  layout: "login",
});

useColorMode().preference = "dark";

const waitingLogin = ref(false);

const schema = yup.object({
  email: yup
    .string()
    .required("O email é obrigatório")
    .trim()
    .email("Email deve ser válido")
    .max(50, "Email deve ter no máximo 50 caracteres"),
  password: yup
    .string()
    .required("Senha é obrigatória")
    .trim()
    .min(5, "Senha deve ter no mínimo 5 caracteres")
    .max(20, "Senha deve ter no máximo 20 caracteres"),
});

type Schema = yup.InferType<typeof schema>;

const state = reactive<{
  email: string | undefined;
  password: string | undefined;
}>({
  email: undefined,
  password: undefined,
});

const { login } = useSanctumAuth<ApiResponse>();

async function onSubmit(event: FormSubmitEvent<Schema>) {
  try {
    waitingLogin.value = true;
    await login(event.data);
    toast().success({
      description: "Login realizado com sucesso",
    });
  } catch (error) {
    toast().error({
      description: (error as { message?: string })?.message || "Ocorreu um erro",
    });
  } finally {
    waitingLogin.value = false;
  }
}
</script>

<template>
  <div class="h-[100dvh] flex justify-center items-center">
    <UForm
      :schema="schema"
      :state="state"
      class="space-y-4 w-screen"
      @submit="onSubmit"
    >
      <UCard class="mx-auto w-10/12 md:w-4/12">
        <template #header>
          <h1 class="text-2xl font-bold">Login</h1>
        </template>

        <div class="flex flex-col gap-4">
          <UFormField label="Email" name="email" :required="true">
            <UInput v-model="state.email" class="w-full"/>
          </UFormField>

          <UFormField label="Senha" name="password" :required="true">
            <UInput v-model="state.password" type="password" class="w-full"/>
          </UFormField>
        </div>

        <template #footer>
          <div class="flex justify-between">
            <div/>
            <UButton
              size="md"
              color="primary"
              type="submit"
              trailing
              loading-icon="svg-spinners:90-ring-with-bg"
              :loading="waitingLogin"
            >
              Entrar
            </UButton>
          </div>
        </template>
      </UCard>
    </UForm>
  </div>
</template>
