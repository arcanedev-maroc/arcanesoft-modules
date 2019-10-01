<template>
    <a class="nav-link nav-link-fullscreen" @click.prevent="toggle">
        <i class="fas fa-fw fa-adjust"></i>
    </a>
</template>

<script lang="ts">
    export default {
        name: "skin-mode-toggler-component",

        register: true,

        data() {
            return {
                selected: null,
            }
        },

        mounted() {
            this.selected = document.body.dataset.skinMode || 'light'
        },

        methods: {
            toggle(): void {
                this.selected = (this.selected === 'light') ? 'dark' : 'light'

                this.save(this.selected)
            },

            save(mode: string): void {
                document.body.dataset.skinMode = this.selected

                window['request']().post('/admin/api/events', {
                    class: "Arcanesoft\\Foundation\\Events\\UI\\SkinModeToggled",
                    options: {mode},
                })

                window['Foundation'].$emit('foundation.ui.skin', {mode})
            }
        },
    }
</script>

<style scoped>

</style>
