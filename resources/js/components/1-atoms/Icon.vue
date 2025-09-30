<script setup lang="ts">
import * as OutlineIcons from "@heroicons/vue/24/outline";
import * as SolidIcons from "@heroicons/vue/24/solid";
import { computed } from "vue";

const props = defineProps<{
  name: string;
  solid?: boolean;
  class?: string;
  size?: number;
}>();

function pascalCaseIcon(name: string) {
  return (
    name
      .split("-")
      .map((part) => part.charAt(0).toUpperCase() + part.slice(1))
      .join("") + "Icon"
  );
}

const iconKey = computed(() => pascalCaseIcon(props.name));
const iconComponent = computed(() =>
  props.solid
    ? (SolidIcons as any)[iconKey.value]
    : (OutlineIcons as any)[iconKey.value]
);

const defaultClass = props.size
  ? `w-[${props.size}px] h-[${props.size}px]`
  : "w-6 h-6";
const computedClass = computed(() => props.class ?? defaultClass);
</script>

<template>
  <component :is="iconComponent" :class="computedClass" aria-hidden="true" />
</template>
