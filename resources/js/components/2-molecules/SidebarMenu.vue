<template>
  <nav class="flex-1 p-4 space-y-2">
    <SidebarMenuItem
      icon="home"
      label="Dashboard"
      to="/dashboard"
      color-class="text-blue-500"
    />
    <SidebarMenuItem
      icon="users"
      label="Clients"
      to="/dashboard/clients"
      :solid="true"
      color-class="text-green-600"
    />
  </nav>
</template>

<script setup lang="ts">
import SidebarMenuItem from "../1-atoms/SidebarMenuItem.vue";
</script>
