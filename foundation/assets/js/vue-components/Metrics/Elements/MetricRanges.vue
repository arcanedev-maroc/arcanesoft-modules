<template>
    <select class="form-control form-control-xs mt-1" @change="changeSelectedRange" v-if="hasRanges">
        <option v-for="range in ranges"
                :key="range.value"
                :value="range.value"
                :selected="isSelected(range.value)">
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
            changeSelectedRange(event): void {
                let selected = parseInt(event.target.value, 10)

                this.$emit('selected-range-changed', selected)
            },

            isSelected(value): Boolean {
                return this.selected === value
            },
        },

        computed: {
            hasRanges(): Boolean {
                return this.ranges.length > 0
            },
        },
    }
</script>

