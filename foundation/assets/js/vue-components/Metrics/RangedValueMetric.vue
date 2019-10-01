<template>
    <MetricCard :loading="isLoading" :allowed="isAllowed">
        <div class="card-body p-3" v-if="isReady">
            <MetricTitle :title="metric.title"/>

            <h3 class="mb-0">{{ formattedValue }}</h3>

            <ValueIcon
                :current="this.result.value"
                :previous="this.result.previous"
                :change="this.result.change"></ValueIcon>
        </div>

        <div class="card-footer p-2" v-if="hasRanges">
            <MetricRanges
                :ranges="metric.ranges"
                :selected="selectedRange"
                @selected-range-changed="handleSelectedRangeChange"/>
        </div>
    </MetricCard>
</template>

<script lang="ts">
    import mixins from './mixins'
    import numeral from 'numeral'
    import MetricCard from './Elements/MetricCard.vue'
    import MetricTitle from './Elements/MetricTitle.vue'
    import MetricRanges from './Elements/MetricRanges.vue'
    import ValueIcon from './Elements/ValueIcon.vue'

    export default {
        name: "ranged-value-metric",

        register: true,

        mixins: [mixins],

        components: {
            MetricCard,
            MetricTitle,
            MetricRanges,
            ValueIcon,
        },

        data: () => ({
            result: {
                value: 0,
                previous: {
                    label: '',
                    value: 0,
                },
                change: {
                    label: '',
                    value: null,
                },
                prefix: '',
                suffix: '',
                format: '(0[.]00a)',
            },

            selectedRange: null,
        }),

        created() {
            if (this.hasRanges)
                this.selectedRange = this.metric.ranges[0].value
        },

        mounted() {
            this.getResults()
        },

        methods: {
            getResults() {
                this.fetch(this.metric.class, this.metricOptions)
            },

            handleSelectedRangeChange(selected) {
                this.selectedRange = selected

                this.getResults()
            },
        },

        computed: {
            formattedValue() {
                if (this.result.value === null)
                    return ''

                return (this.result.prefix || '') + numeral(this.result.value).format(this.result.format)
            },

            hasRanges() {
                return this.metric.ranges.length > 0
            },

            metricOptions() {
                const options = {
                    params: {},
                }

                if (this.hasRanges)
                    options.params['range'] = this.selectedRange

                return options
            },
        },
    }
</script>
