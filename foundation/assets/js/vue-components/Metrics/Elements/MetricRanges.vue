<template>
    <select class="form-control form-control-xs mt-1" @change="changeSelectedRange" v-if="hasRanges">
        <option v-for="range in ranges"
                :key="range.value"
                :value="range.value"
                :selected="range.value === selected">
            {{ range.label }}
        </option>
    </select>
</template>

<script lang="ts">
    export default {
        name: "metric-ranges",

        props: {
            selected: {
                default: null,
            },

            ranges: {
                type: Array,
                default: () => [],
            },
        },

        methods: {
            changeSelectedRange(event) {
                this.$emit('selected-range-changed', event.target.value)
            },
        },

        computed: {
            hasRanges() {
                return this.ranges.length > 0
            },
        },
    }
</script>

