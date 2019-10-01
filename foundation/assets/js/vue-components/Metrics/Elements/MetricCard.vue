<template>
    <div class="card card-borderless shadow-sm mb-3" :class="{'card-loading': loading}">
        <div class="dot-flashing"></div>
        <slot v-if=" ! loading && allowed"></slot>
        <div class="card-locked" v-else-if=" ! allowed">
            <i class="fas fa-3x fa-lock"></i>
        </div>
    </div>
</template>

<script lang="ts">
    export default {
        props: {
            loading: {
                type: Boolean,
                default: true,
            },
            allowed: {
                type: Boolean,
                default: true,
            }
        },
    }
</script>

<style scoped>
    .card-locked {
        justify-content: center;
        display: flex;
        align-items: center;
        min-height: 6rem;
        color: #d9d9d9;
    }
</style>
