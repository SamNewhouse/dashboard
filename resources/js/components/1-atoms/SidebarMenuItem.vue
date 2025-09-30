<template>
  <a
    :href="to"
    class="flex items-center px-3 py-2 rounded transition-colors hover:bg-zinc-200 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-200 font-medium"
  >
    <Icon
      :name="icon"
      :solid="solid"
      class="mr-2 w-5 h-5"
      :class="colorClass"
    />
    <span>{{ label }}</span>
  </a>
</template>

<script setup lang="ts">
import Icon from "../1-atoms/Icon.vue";
const props = defineProps<{
  icon: string; // The Heroicons icon name (e.g. 'users')
  label: string; // Display label (e.g. 'Clients')
  to: string; // Link destination
  solid?: boolean; // use solid icons if true
  colorClass?: string; // optional Tailwind color for the icon
}>();
</script>
