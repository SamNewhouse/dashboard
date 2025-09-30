<template>
  <DashboardLayout>
    <template #title>
      <span
        class="text-2xl font-bold text-zinc-900 dark:text-white tracking-wide"
      >
        Clients
      </span>
    </template>
    <section class="mt-8">
      <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-zinc-700 dark:text-zinc-200">
          All Clients
        </h2>
        <router-link
          to="/clients/new"
          class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-lg bg-zinc-200 dark:bg-zinc-700 text-zinc-800 dark:text-zinc-100 shadow hover:bg-zinc-300 dark:hover:bg-zinc-600 transition duration-150 ease-in-out"
        >
          <Icon name="plus" solid class="w-5 h-5" />
          Add New Client
        </router-link>
      </div>
      <div class="overflow-x-auto">
        <ClientTable :clients="clients" />
        <div class="flex items-center justify-end gap-3 my-4">
          <div class="flex items-center gap-2 mr-4">
            <label
              for="perPage"
              class="text-sm text-zinc-700 dark:text-zinc-200 font-medium"
              >Show</label
            >
            <select
              id="perPage"
              class="border rounded px-2 py-1 bg-zinc-100 dark:bg-zinc-700 text-zinc-800 dark:text-zinc-100"
              :value="perPage"
              @change="onPerPageChange"
            >
              <option :value="10">10</option>
              <option :value="20">20</option>
              <option :value="30">30</option>
              <option :value="50">50</option>
            </select>
          </div>
          <button
            v-if="pagination.current_page > 1"
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-lg bg-zinc-200 dark:bg-zinc-700 text-zinc-800 dark:text-zinc-100 shadow hover:bg-zinc-300 dark:hover:bg-zinc-600 transition duration-150 ease-in-out"
            @click="goToPage(pagination.current_page - 1)"
          >
            Prev
          </button>
          <span class="px-2 text-zinc-700 dark:text-zinc-200">
            Page {{ pagination.current_page }} of {{ pagination.last_page }}
          </span>
          <button
            class="inline-flex items-center gap-2 px-5 py-2.5 text-sm font-semibold rounded-lg bg-zinc-200 dark:bg-zinc-700 text-zinc-800 dark:text-zinc-100 shadow hover:bg-zinc-300 dark:hover:bg-zinc-600 transition duration-150 ease-in-out"
            :disabled="pagination.current_page === pagination.last_page"
            @click="goToPage(pagination.current_page + 1)"
          >
            Next
          </button>
        </div>
      </div>
    </section>
  </DashboardLayout>
</template>

<script setup lang="ts">
import DashboardLayout from "../4-layouts/DashboardLayout.vue";
import ClientTable from "../3-organisms/ClientTable.vue";
import Icon from "../1-atoms/Icon.vue";
import { ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";

type Client = {
  id: number;
  name: string;
  email: string;
  status: string;
  sessions?: number;
  total_spend?: number;
  created_at?: string;
};

const clients = ref<Client[]>([]);
const pagination = ref({
  current_page: 1,
  last_page: 1,
  total: 0,
  per_page: 20,
});

const route = useRoute();
const router = useRouter();

const page = ref(Number(route.params.page) || 1);
const perPage = ref(Number(route.params.perPage) || 20);

const fetchClients = async () => {
  const resp = await fetch(
    `/api/clients?page=${page.value}&per_page=${perPage.value}`
  );
  const json = await resp.json();
  clients.value = json.data ?? [];
  pagination.value = {
    current_page: json.current_page,
    last_page: json.last_page,
    total: json.total,
    per_page: json.per_page,
  };
};

watch(
  [() => route.params.page, () => route.params.perPage],
  ([newPage, newPerPage]) => {
    page.value = Number(newPage) || 1;
    perPage.value = Number(newPerPage) || 20;
    fetchClients();
  },
  { immediate: true }
);

const goToPage = (newPage: number) => {
  router.push({
    name: "ClientsPaginated",
    params: { page: newPage, perPage: perPage.value },
  });
};

const onPerPageChange = (event: Event) => {
  const newVal = Number((event.target as HTMLSelectElement).value);
  router.push({
    name: "ClientsPaginated",
    params: { page: 1, perPage: newVal },
  });
};
</script>
