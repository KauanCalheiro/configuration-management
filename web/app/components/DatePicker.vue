<script setup lang="ts">
import {
  CalendarDate,
  DateFormatter,
  getLocalTimeZone,
  type DateValue,
} from "@internationalized/date";
import type { DateRange } from "reka-ui";

const {
  trailingIcon,
  arrow = true,
  minDate,
  maxDate,
} = defineProps<{
  trailingIcon?: string;
  arrow?: boolean;
  minDate?: CalendarDate;
  maxDate?: CalendarDate;
}>();

const modelValue = defineModel<string | number | undefined | null>();
const calendarValue = shallowRef<CalendarDate>();

const showCalendar = ref(false);

async function onCalendarChange(
  date: DateValue | DateRange | DateValue[] | null | undefined
) {
  modelValue.value = date?.toString();
  await new Promise((resolve) => setTimeout(resolve, 300));
}

function onChangeInput(event: Event) {
  const input = event.target as HTMLInputElement;
  const value = input.value;
  if (value) {
    const [year, month, day] = value.split("-").map(Number);
    if (!year || !month || !day) {
      return;
    }
    const date = new CalendarDate(year, month, day);
    if (date) {
      calendarValue.value = date;
    }
  } else {
    calendarValue.value = undefined;
  }
}

function isDateUnavailable (date: DateValue) {
  return (
    (minDate && date.compare(minDate) < 0) ||
    (maxDate && date.compare(maxDate) > 0)
  );
};

function inputLength() {
  return typeof modelValue.value === "string" ? modelValue.value.length : 0;
}
</script>

<template>
  <UPopover v-model:open="showCalendar" :arrow="arrow">
    <UButton class="p-0 m-0">
      <UInput
        v-model="modelValue"
        type="date"
        :trailing-icon="trailingIcon"
        class="w-full"
        @focus="showCalendar = true"
        @blur="showCalendar = false"
        @input="onChangeInput"
      >
        <template #trailing>
          <UButton
              icon="i-lucide-circle-x"
              size="sm"
              color="error"
              variant="ghost"
              @click="modelValue = undefined"
              v-if="inputLength() > 0"
            />
          <UIcon v-if="trailingIcon && inputLength() <= 0" :name="trailingIcon" class="size-4 bg-neutral-400 m-1.5"/>

        </template>
      </UInput>
    </UButton>

    <template #content>
      <UCalendar
        class="p-4"
        v-if="showCalendar"
        v-model="calendarValue"
        @update:modelValue="onCalendarChange"
        :min-value="minDate"
        :max-value="maxDate"
        :is-date-unavailable="isDateUnavailable"
      />
    </template>
  </UPopover>
</template>

<style lang="css">
input[type="date"]::-webkit-inner-spin-button,
input[type="date"]::-webkit-calendar-picker-indicator {
  display: none;
  -webkit-appearance: none;
}
</style>
