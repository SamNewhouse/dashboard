<template>
  <tr>
    <TableCell>{{ client.name }}</TableCell>
    <TableCell>{{ client.email }}</TableCell>
    <TableCell>
      <span
        :class="
          client.status === 'active'
            ? 'bg-green-100 text-green-800 dark:bg-green-900/80 dark:text-green-200'
            : 'bg-red-100 text-red-800 dark:bg-red-900/80 dark:text-red-200'
        "
        class="px-2 py-1 rounded text-xs font-semibold"
      >
        {{ client.status }}
      </span>
    </TableCell>
    <TableCell>{{ client.sessions ?? "-" }}</TableCell>
    <TableCell
      >£{{
        client.total_spend
          ? Number(client.total_spend).toLocaleString()
          : "0.00"
      }}</TableCell
    >
    <TableCell>
      {{
        client.created_at
          ? new Date(client.created_at).toLocaleDateString("en-GB", {
              year: "2-digit",
              month: "short",
              day: "2-digit",
            })
          : "-"
      }}
    </TableCell>
  </tr>
</template>

<script setup lang="ts">
import TableCell from "../1-atoms/TableCell.vue";
defineProps<{ client: any }>();
</script>
