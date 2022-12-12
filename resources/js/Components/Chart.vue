<script setup>
import { ref } from 'vue';
import { Bar } from 'vue-chartjs'
import ChartDataLabels from 'chartjs-plugin-datalabels';
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(ChartDataLabels, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps({
    chartData: Object,
    chartOptions: Object,
});
const chartOptionsFix = ref(JSON.parse(JSON.stringify(props.chartOptions)));
</script>

<template>
    <Bar :chart-options="chartOptionsFix" :chart-data="chartData" />
</template>
