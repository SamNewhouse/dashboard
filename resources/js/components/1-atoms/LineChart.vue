<template>
  <div class="flex">
    <Line :data="chartData" :options="chartOptions" />
  </div>
</template>

<script setup lang="ts">
import { Line } from "vue-chartjs";
import {
  Chart,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
  Tooltip,
  Legend,
} from "chart.js";
Chart.register(
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
  Tooltip,
  Legend
);

const props = defineProps<{
  labels: string[];
  data: number[];
  color?: string;
}>();

const chartData = {
  labels: props.labels,
  datasets: [
    {
      label: "New Clients",
      data: props.data,
      borderColor: props.color ?? "#3b82f6",
      backgroundColor: "rgba(59,130,246,0.15)",
      fill: true,
      tension: 0.4,
    },
  ],
};
const chartOptions = {
  responsive: true,
  plugins: {
    legend: { display: false },
  },
  scales: {
    x: { grid: { color: "#d4d4d8" } },
    y: { grid: { color: "#d4d4d8" } },
  },
};
</script>
