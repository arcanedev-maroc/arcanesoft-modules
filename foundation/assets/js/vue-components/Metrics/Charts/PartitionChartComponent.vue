<template>
    <canvas ref="chart"></canvas>
</template>

<script lang="ts">
    export default {
        name: "partition-chart-component",

        props: {
            data: {
                type: Array,
                required: true,
            },
            labels: {
                type: Array,
                default: () => [],
            },
            colors: {
                type: Array,
                default: () => [],
            }
        },

        mounted() {
            window['plugins'].chartJs(this.$refs.chart, {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: this.data,
                        backgroundColor: this.colors,
                    }],
                    labels: this.labels,
                },
                options: {
                    cutoutPercentage: 80,
                    rotation: 270,
                    legend: {
                        display: false
                    },
                    tooltips: {
                        enabled: true,
                        displayColors: false,
                        callbacks: {
                            label(tooltipItem, data) {
                                let dataset = data.datasets[tooltipItem.datasetIndex]
                                let value = dataset.data[tooltipItem.index]
                                let total = Object.values(dataset._meta)[0]['total']

                                return (total > 0 ? ((value * 100) / total).toFixed(2) : '0')+'%'
                            },
                        }
                    }
                }
            })
        },
    }
</script>
