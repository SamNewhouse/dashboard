<template>
  <div
    class="bg-zinc-200 dark:bg-gray-800 rounded shadow p-6 flex flex-col items-start"
  >
    <div class="text-gray-500 dark:text-gray-400 text-xs uppercase">
      {{ label }}
    </div>
    <div class="text-2xl font-bold text-gray-800 dark:text-gray-100 mt-1">
      {{ value }}
    </div>
  </div>
</template>

<script setup lang="ts">
defineProps<{ label: string; value: string | number }>();
</script>
