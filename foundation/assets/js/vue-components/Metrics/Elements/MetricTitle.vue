<template>
    <h6 class="d-flex font-weight-semibold text-muted mb-1">
        {{ title }}
        <small class="ml-auto" v-if="hasTotal">({{ total }} Total)</small>
    </h6>
</template>

<script lang="ts">
    export default {
        props: {
            title: {
                type: String,
                required: true,
            },
            total: {
                default: null,
            },
        },

        computed: {
            hasTotal() {
                return this.total !== null
            },
        },
    }
</script>
