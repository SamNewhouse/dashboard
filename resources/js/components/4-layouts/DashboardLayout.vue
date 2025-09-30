<template>
  <div class="min-h-screen bg-white dark:bg-gray-900 flex flex-col">
    <Topbar class="w-full sticky top-0 z-10" />
    <div class="flex flex-row flex-1">
      <aside class="hidden md:block md:w-64 bg-zinc-300 dark:bg-gray-800">
        <SidebarMenu />
      </aside>
      <main class="flex-1 p-5 md:p-10">
        <slot />
      </main>
    </div>
  </div>
</template>

<script setup lang="ts">
import SidebarMenu from "../2-molecules/SidebarMenu.vue";
import Topbar from "../3-organisms/Topbar.vue";
</script>
