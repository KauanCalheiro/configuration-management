<script setup lang="ts">
import type Task from "~~/types/Task";
import { date, number, object, string, type InferType } from "yup";
import type { FormSubmitEvent } from "@nuxt/ui";
import type ApiResponse from "~~/types/ApiResponse";
import { CalendarDate, getLocalTimeZone, now } from "@internationalized/date";

const { task } = defineProps<{
  task: Task | undefined;
}>();

const emit = defineEmits<{
  afterSave: [];
}>();

const isEditing = !!task;

const schema = object({
  id: number().optional(),
  description: string()
    .required("Preencha a descrição.")
    .max(50, "A descrição pode ter no máximo 50 caracteres."),
  due_date: date()
    .typeError("Informe uma data válida.")
    .nullable()
    .max(new Date(9999, 11, 31), "A data deve ser até o ano 9999."),
  completed_at: date()
    .typeError("Informe uma data válida.")
    .nullable()
    .max(new Date(9999, 11, 31), "A data deve ser até o ano 9999."),
  status: string()
    .required("Selecione um status.")
    .oneOf(
      ["Em andamento", "Concluido", "Parado"],
      "Selecione um status válido."
    ),
});

type UserSchema = InferType<typeof schema>;

const state = reactive<{
  id: number | undefined;
  description: string | undefined;
  due_date: string | null;
  completed_at: string | null;
  status: string | undefined;
}>({
  id: task?.id,
  description: task?.description,
  due_date: task?.due_date || null,
  completed_at: task?.completed_at || null,
  status: task?.status,
});

const currentDate = now(getLocalTimeZone()).add({days: -7});
const startDate = new CalendarDate(
  currentDate.year,
  currentDate.month,
  currentDate.day
);

const loading = ref(false);

async function onSubmit(event: FormSubmitEvent<UserSchema>) {
  loading.value = true;
  try {
    let { error } = await useSanctumFetch<ApiResponse<Task>>(
      isEditing ? `/task/${state.id}` : "/task",
      {
        method: isEditing ? "PUT" : "POST",
        body: {
          description: event.data.description,
          due_date: event.data.due_date,
          completed_at: event.data.completed_at,
          status: event.data.status,
        },
      }
    );

    if (error.value) {
      throw new Error();
    }

    toast().success({
      description: isEditing
        ? "Tarefa editada com sucesso"
        : "Tarefa cadastrada com sucesso",
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
    :validateOn="['blur']"
    class="flex flex-col gap-8 px-8 py-8 rounded-lg w-full md:min-h-[80vh] md:w-[30vw] mx-auto justify-center"
  >
    <BaseTitle :title="isEditing ? 'Editar Usuário' : 'Cadastrar Usuário'" />

    <div class="flex flex-col gap-4">
      <UInput v-model="state.id" type="hidden" />

      <UFormField label="Descrição" name="description" required>
        <UInput
          v-model="state.description"
          placeholder="Digite a descrição da tarefa"
          class="w-full"
        />
      </UFormField>
      <UFormField label="Status" name="status" required>
        <USelect
          v-model="state.status"
            :items="[
            { label: 'Em andamento', value: 'Em andamento' },
            { label: 'Concluido', value: 'Concluido' },
            { label: 'Parado', value: 'Parado' },
          ]"
          placeholder="Selecione o status"
          class="w-full"
        />
      </UFormField>
      <UFormField label="Data de Vencimento" name="due_date">
        <DatePicker
          v-model="state.due_date"
          trailing-icon="mdi:calendar-month-outline"
          class="w-full"
          :min-date="startDate"
        />
      </UFormField>
      <UFormField label="Data de Conclusão" name="completed_at">
        <DatePicker
          v-model="state.completed_at"
          trailing-icon="mdi:calendar-month-outline"
          class="w-full"
          :min-date="startDate"
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
