<template>
  <table class="min-w-full rounded">
    <thead>
      <tr class="bg-zinc-200 dark:bg-gray-800">
        <TableCell>Name</TableCell>
        <TableCell>Email</TableCell>
        <TableCell>Status</TableCell>
        <TableCell>Sessions</TableCell>
        <TableCell>Total Spend</TableCell>
        <TableCell>Created</TableCell>
      </tr>
    </thead>
    <tbody>
      <TableRow v-for="client in clients" :key="client.id" :client="client" class="even:bg-zinc-400/25 dark:even:bg-gray-800/30" />
    </tbody>
  </table>
</template>

<script setup lang="ts">
import TableCell from "../1-atoms/TableCell.vue";
import TableRow from "../2-molecules/TableRow.vue";
defineProps<{ clients: any[] }>();
</script>
