<template>
  <header
    class="flex items-center justify-between px-8 py-4 w-full bg-zinc-300 dark:bg-gray-800"
  >
    <div class="flex items-center space-x-3">
      <span
        class="hidden sm:block text-2xl font-bold text-zinc-800 dark:text-white tracking-wide"
        >Dashboard</span
      >
      <slot name="title"></slot>
    </div>

    <div class="flex items-center space-x-4">
      <button
        class="p-2 rounded hover:bg-zinc-200 dark:hover:bg-gray-700 transition-colors"
        @click="toggleDark"
        title="Toggle theme"
      >
        <Icon
          :name="isDark ? 'moon' : 'sun'"
          class="w-6 h-6 text-zinc-700 dark:text-gray-300"
        />
      </button>

      <!--
      <button
        class="relative p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
      >
        <Icon name="bell" class="w-6 h-6 text-gray-400 dark:text-gray-300" />
        <span
          v-if="notifications > 0"
          class="absolute top-0 right-0 rounded-full bg-rose-500 text-xs text-white px-1"
        >
          {{ notifications }}
        </span>
      </button>
      -->

      <div
        class="relative ml-2"
        @mouseenter="showMenu = true"
        @mouseleave="showMenu = false"
      >
        <div
          class="h-10 w-10 rounded-full bg-center bg-cover cursor-pointer transition-shadow hover:shadow-md"
          :style="{ backgroundImage: `url('${userAvatar}')` }"
        ></div>
        <transition
          enter-active-class="transition-all"
          leave-active-class="transition-all"
        >
          <div
            v-if="showMenu"
            class="absolute right-0 mt-2 w-44 bg-white shadow-lg rounded border border-gray-100 z-50 py-2 dark:bg-gray-800 dark:border-gray-700"
          >
            <a
              href="/profile"
              class="block px-4 py-2 text-gray-700 hover:bg-zinc-200 font-medium dark:text-white dark:hover:bg-gray-700"
              >Profile</a
            >
            <a
              href="/settings"
              class="block px-4 py-2 text-gray-700 hover:bg-zinc-200 font-medium dark:text-white dark:hover:bg-gray-700"
              >Settings</a
            >
            <button
              class="block w-full text-left px-4 py-2 text-rose-600 hover:bg-rose-100 font-medium dark:text-red-600 dark:hover:bg-red-700"
              @click="logout"
            >
              Logout
            </button>
          </div>
        </transition>
      </div>
    </div>
  </header>
</template>

<script setup lang="ts">
import Icon from "../1-atoms/Icon.vue";
import { ref, onMounted } from "vue";

const showMenu = ref(false);
const notifications = ref(7);

const userAvatar =
  "https://images.unsplash.com/photo-1758600436719-29d562218087?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D";

const storedTheme = localStorage.getItem("theme");
const isDark = ref(storedTheme ? storedTheme === "dark" : true); // default to dark mode

onMounted(() => {
  if (isDark.value) {
    document.documentElement.classList.add("dark");
  } else {
    document.documentElement.classList.remove("dark");
  }
});

function toggleDark() {
  isDark.value = !isDark.value;
  if (isDark.value) {
    document.documentElement.classList.add("dark");
    localStorage.setItem("theme", "dark");
  } else {
    document.documentElement.classList.remove("dark");
    localStorage.setItem("theme", "light");
  }
}

function logout() {
  window.location.href = "/logout";
}
</script>
