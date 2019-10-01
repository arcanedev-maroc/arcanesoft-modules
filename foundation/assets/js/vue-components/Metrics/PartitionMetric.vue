<template>
    <MetricCard :loading="isLoading" :allowed="isAllowed">
        <div class="card-body p-3" v-if="isReady">
            <MetricTitle :title="metric.title" :total="total"/>

            <div class="d-flex justify-content-between flex-nowrap">
                <ul class="list-unstyled mb-0">
                    <li v-for="item in this.formattedItems">
                        <span class="status" :style="`background-color: ${item.color};`"></span>
                        <small>{{ item.label }} ({{ item.value }})</small>
                    </li>
                </ul>

                <div style="position: relative; max-height: 100px; width: 100px;">
                    <PartitionChartComponent :data="values" :labels="labels" :colors="colors"/>
                </div>
            </div>
        </div>
    </MetricCard>
</template>

<script lang="ts">
    import mixins from './mixins'
    import MetricCard from './Elements/MetricCard.vue'
    import MetricTitle from './Elements/MetricTitle.vue'
    import PartitionChartComponent from './Charts/PartitionChartComponent.vue'

    export default {
        name: "partition-metric",

        register: true,

        mixins: [mixins],

        components: {
            MetricCard,
            MetricTitle,
            PartitionChartComponent,
        },

        mounted() {
            this.fetch(this.metric.class)
        },

        methods: {
            mapItems(callback) {
                return this.result.value.map(callback)
            },

            getColor(item, index) {
                return typeof item.color === 'string' ? item.color : this.getColorByIndex(index)
            },

            getColorByIndex(index) {
                const colors = [
                    '#007BFF',
                    '#6610F2',
                    '#6F42C1',
                    '#E83E8C',
                    '#DC3545',
                    '#FD7E14',
                    '#FFC107',
                    '#28A745',
                    '#20C997',
                    '#17A2B8',
                ]

                let total = (colors.length - 1)

                return colors[index > total ? (index % total) : index]
            },
        },

        computed: {
            values() {
                return this.mapItems(item => item.value)
            },

            labels() {
                return this.mapItems(item => item.label)
            },

            colors() {
                return this.mapItems((item, index) => this.getColor(item, index))
            },

            formattedItems() {
                return this.mapItems((item, index) => {
                    return {
                        label: item.label,
                        value: item.value,
                        color: this.getColor(item, index),
                    }
                })
            },

            total() {
                return this.values.reduce((accumulator, value) => accumulator + value)
            },
        }
    }
</script>

<style scoped>
    .ct-chart {
        width: 90px;
        height: 90px;
    }
</style>
