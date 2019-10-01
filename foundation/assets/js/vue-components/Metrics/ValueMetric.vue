<template>
    <MetricCard :loading="isLoading" :allowed="isAllowed">
        <div class="card-body p-3" v-if="isReady">
            <MetricTitle :title="metric.title"/>

            <h3 class="mb-0">{{ formattedValue }}</h3>
        </div>
    </MetricCard>
</template>

<script lang="ts">
    import mixins from './mixins'
    import numeral from 'numeral'
    import MetricCard from './Elements/MetricCard.vue'
    import MetricTitle from './Elements/MetricTitle.vue'
    import ValueIcon from './Elements/ValueIcon.vue'

    export default {
        name: "value-metric",

        register: true,

        mixins: [mixins],

        components: {
            MetricCard,
            MetricTitle,
            ValueIcon,
        },

        data: () => ({
            result: {
                value: 0,
                prefix: '',
                suffix: '',
                format: '(0[.]00a)',
            },
        }),

        mounted() {
            this.fetch(this.metric.class)
        },

        computed: {
            formattedValue() {
                if (this.result.value === null)
                    return ''

                return (this.result.prefix || '') + numeral(this.result.value).format(this.result.format)
            },
        },
    }
</script>

<style scoped>
    .card .card-locked {
        justify-content: center;
        display: flex;
        align-items: center;
        min-height: 6rem;
        color: #d9d9d9;
    }
</style>
