<template>
    <div class="card-chart" style="height: 8rem;">
        <canvas ref="chart"></canvas>
    </div>
</template>

<script lang="ts">
    export default {
        name: "trend-chart-component",

        props: {
            legend: {
                type: String,
                required: true
            },
            data: {
                type: Array,
                required: true,
            },
            labels: {
                type: Array,
                default: () => [],
            }
        },

        data: () => ({
            chart: null,
        }),

        mounted() {
            this.chart = window["plugins"].chartJs(this.$refs.chart, {
                type: 'line',
                data: {
                    labels: this.labels,
                    datasets: [
                        {
                            label: this.legend,
                            lineTension: 0,
                            backgroundColor: "rgba(0, 123, 255, 0.05)",
                            borderColor: "rgba(0, 123, 255, 0.5)",
                            pointBackgroundColor: "rgba(0, 123, 255, 0.5)",
                            pointBorderColor: "rgba(0, 123, 255, 0.7)",
                            data: this.data,
                        },
                    ],
                },
                options: {
                    layout: {
                        padding: {
                            top: 10,
                        },
                    },
                    legend: {
                        display: false,
                    },
                    scales: {
                        xAxes: [{
                            display: false,
                        }],
                        yAxes: [{
                            display: false,
                        }],
                    },
                },
            })
        },

        destroyed() {
            this.chart.destroy()
        },
    }
</script>
