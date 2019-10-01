<template>
    <a @click.prevent="toggle"
       class="navbar-sidebar-toggler nav-link d-flex align-items-center border-0 rounded-0 cursor-pointer">
        <i class="fas fa-fw fa-bars"></i>
    </a>
</template>

<script lang="ts">
    export default {
        name: 'sidebar-toggler-component',

        register: true,

        methods: {
            toggle(): void {
                let visible = document.querySelector('body').dataset.sidebarVisible || 'true'

                this.save(visible === 'true' ? 'false' : 'true')
            },

            save(visible: string): void {
                document.querySelector('body').dataset.sidebarVisible = visible

                window['request']().post('/admin/api/events', {
                    class: "Arcanesoft\\Foundation\\Events\\UI\\SidebarToggled",
                    options: {visible},
                })

                window['Foundation'].$emit('foundation.ui.sidebar', {visible})
            },
        }
    }
</script>
