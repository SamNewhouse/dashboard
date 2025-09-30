<template>
  <DashboardLayout>
    <template #title>Dashboard</template>
    <section class="space-y-10">
      <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
        <CardStat label="Total Clients" :value="clients.length" />
        <CardStat label="Active Clients" :value="activeCount" />
        <CardStat label="Suspended Clients" :value="suspendedCount" />
        <CardStat label="New This Month" :value="newThisMonth" />
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
        <div
          class="bg-zinc-100 dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center"
        >
          <h3
            class="text-base font-semibold mb-3 text-zinc-800 dark:text-zinc-100"
          >
            Client Distribution
          </h3>
          <template v-if="isPieChartReady">
            <PieChart :data="pieChartData" />
            <dl
              class="flex flex-row text-xs space-x-3 text-zinc-700 dark:text-zinc-100 mt-2"
            >
              <div>
                <dt>Active:</dt>
                <dd class="inline">{{ activeCount }}</dd>
              </div>
              <div>
                <dt>Suspended:</dt>
                <dd class="inline">{{ suspendedCount }}</dd>
              </div>
              <div>
                <dt>New:</dt>
                <dd class="inline">{{ newThisMonth }}</dd>
              </div>
            </dl>
          </template>
          <template v-else>
            <div class="text-zinc-400 text-sm">Loading chart data...</div>
          </template>
        </div>

        <div
          class="bg-zinc-100 dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center"
        >
          <h3
            class="text-base font-semibold mb-3 text-zinc-800 dark:text-zinc-100"
          >
            Growth Trend
          </h3>
          <template
            v-if="!loadingClients && clientsPerMonth.some((val) => val > 0)"
          >
            <LineChart
              :labels="monthLabels"
              :data="clientsPerMonth"
              color="#3b82f6"
            />
            <p class="text-xs text-zinc-700 dark:text-zinc-300 mt-2">
              New clients per month (last 6 months)
            </p>
          </template>
          <template v-else>
            <div class="text-zinc-400 text-sm">Loading chart data...</div>
          </template>
        </div>
        <div
          class="bg-zinc-100 dark:bg-gray-800 rounded-lg shadow p-6 flex flex-col items-center"
        >
          <h3
            class="text-base font-semibold mb-3 text-zinc-800 dark:text-zinc-100"
          >
            Avg. Engagement
          </h3>
          <div class="text-3xl font-bold text-blue-600 dark:text-blue-400">
            {{ avgSessions }}
          </div>
          <p class="text-xs text-zinc-500 dark:text-zinc-400">
            Sessions per client
          </p>
        </div>
      </div>

    </section>
  </DashboardLayout>
</template>

<script setup lang="ts">
import DashboardLayout from "../4-layouts/DashboardLayout.vue";
import CardStat from "../2-molecules/CardStat.vue";
import PieChart from "../1-atoms/PieChart.vue";
import LineChart from "../1-atoms/LineChart.vue";
import { ref, onMounted, computed } from "vue";

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

const loadingClients = ref(true);

const fetchClients = async () => {
  loadingClients.value = true;
  const resp = await fetch("/api/clients");
  const json = await resp.json();
  clients.value = json.data ?? json;
  loadingClients.value = false;
};

onMounted(fetchClients);

const activeCount = computed(
  () => clients.value.filter((c) => c.status === "active").length
);

const suspendedCount = computed(
  () => clients.value.filter((c) => c.status === "suspended").length
);

const newThisMonth = computed(() => {
  const now = new Date();
  return clients.value.filter((c) => {
    if (!c.created_at) return false;
    const d = new Date(c.created_at);
    return (
      d.getMonth() === now.getMonth() && d.getFullYear() === now.getFullYear()
    );
  }).length;
});

const avgSessions = computed(() => {
  if (!clients.value.length) return 0;
  const sum = clients.value.reduce((acc, c) => acc + (c.sessions ?? 0), 0);
  return (sum / clients.value.length).toFixed(1);
});

const isPieChartReady = computed(
  () =>
    !loadingClients.value && pieChartData.value.some((slice) => slice.value > 0)
);

const pieChartData = computed(() => [
  { label: "Active", value: activeCount.value, color: "#22c55e" },
  { label: "Suspended", value: suspendedCount.value, color: "#ef4444" },
  { label: "New", value: newThisMonth.value, color: "#3b82f6" },
]);

const monthLabels = computed(() => {
  const now = new Date();
  return Array.from({ length: 6 }, (_, i) => {
    const date = new Date(now.getFullYear(), now.getMonth() - (5 - i));
    return date.toLocaleDateString("en-US", { month: "short" });
  });
});

const clientsPerMonth = computed(() => {
  if (loadingClients.value || !clients.value.length) {
    return null;
  }
  const now = new Date();
  const counts = Array(6).fill(0);
  clients.value.forEach((c) => {
    if (!c.created_at) return;
    const d = new Date(c.created_at);
    if (isNaN(d)) return;
    const diff =
      (now.getFullYear() - d.getFullYear()) * 12 +
      (now.getMonth() - d.getMonth());
    if (diff >= 0 && diff < 6) counts[5 - diff]++;
  });
  return counts;
});
</script>
