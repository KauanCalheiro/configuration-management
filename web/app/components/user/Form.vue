<script setup lang="ts">
import type User from "~~/types/User";
import { mixed, number, object, string, type InferType } from "yup";
import type { FormSubmitEvent } from "@nuxt/ui";
import type ApiResponse from "~~/types/ApiResponse";

const { user } = defineProps<{
  user: User | undefined;
}>();

const emit = defineEmits<{
  afterSave: [];
}>();

const isEditing = !!user;

const schema = object({
  id: number().optional(),
  name: string()
    .required("O nome é obrigatório")
    .trim()
    .min(3, "Deve ter pelo menos 3 caracteres"),
  email: string()
    .required("O email é obrigatório")
    .email("Deve ser um email válido"),
  password: string()
    .required("A senha é obrigatória")
    .min(6, "A senha deve ter pelo menos 6 caracteres"),
});

type UserSchema = InferType<typeof schema>;

const state = reactive<{
  id: number | undefined;
  name: string | undefined;
  email: string | undefined;
  password: string | undefined;
}>({
  id: user?.id,
  name: user?.name,
  email: user?.email,
  password: undefined,
});

const loading = ref(false);

async function onSubmit(event: FormSubmitEvent<UserSchema>) {
  loading.value = true;
  try {
    let { error } = await useSanctumFetch<ApiResponse<User>>(
      isEditing ? `/user/${state.id}` : "/user",
      {
        method: isEditing ? "PUT" : "POST",
        body: {
          name: event.data.name,
          email: event.data.email,
          password: event.data.password,
          password_confirmation: event.data.password,
        }
      }
    );

    if (error.value) {
      throw new Error();
    }

    toast().success({
      description: isEditing
        ? "Usuário editado com sucesso"
        : "Usuário cadastrado com sucesso",
    });

    emit("afterSave");
  } catch {
    let error: any = useNuxtApp().$lastSanctumError;
    toast().error({
      description: error?.value?._data?.message || "Ocorreu um erro",
    });
  } finally {
    loading.value = false;
  }
}
</script>

<template>
  <UForm
    :schema="schema"
    :state="state"
    @submit="onSubmit"
    class="flex flex-col gap-8 px-8 py-8 rounded-lg w-full md:min-h-[80vh] md:w-[30vw] mx-auto justify-center"
  >
    <BaseTitle :title="isEditing ? 'Editar Usuário' : 'Cadastrar Usuário'" />

    <div class="flex flex-col gap-4">
      <UInput v-model="state.id" type="hidden" />

      <UFormField label="Nome" name="name" required>
        <UInput
          v-model="state.name"
          placeholder="Digite o nome do usuário"
          class="w-full"
        />
      </UFormField>
      <UFormField label="Email" name="email" required>
        <UInput
          v-model="state.email"
          placeholder="Digite o email do usuário"
          autocomplete="off"
          class="w-full"
        />
      </UFormField>
      <UFormField v-if="!isEditing" label="Senha" name="password" required>
        <UInput
          v-model="state.password"
          type="password"
          placeholder="Digite a senha do usuário"
          autocomplete="new-password"
          class="w-full"
        />
      </UFormField>
    </div>

    <div class="flex flex-row gap-4 justify-between mt-6">
      <div />
      <UButton
        variant="soft"
        size="xl"
        type="submit"
        trailing
        loading-icon="svg-spinners:90-ring-with-bg"
        :loading="loading"
      >
        Salvar
      </UButton>
    </div>
  </UForm>
</template>
