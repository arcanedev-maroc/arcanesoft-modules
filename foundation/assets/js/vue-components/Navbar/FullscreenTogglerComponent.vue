<template>
    <a class="nav-link nav-link-fullscreen" @click.prevent="toggle">
        <i :class="fullscreenIcon"></i>
    </a>
</template>

<script lang="ts">
    import {Screenfull} from "screenfull"
    import * as screenfull from "screenfull"

    export default {
        name: "fullscreen-toggler-component",

        register: true,

        data: () =>({
            isFullscreen: false,
        }),

        methods: {
            toggle() {
                let sf = <Screenfull> screenfull

                if (sf.isEnabled) {
                    sf.toggle().then(() => {
                        this.isFullscreen = sf.isFullscreen

                        window['Foundation'].$emit('foundation.ui.fullscreen', {
                            isFullscreen: this.isFullscreen
                        })
                    })
                }
            },
        },

        computed: {
            fullscreenIcon() {
                return this.isFullscreen ? 'fa fa-fw fa-compress' : 'fa fa-fw fa-expand'
            },
        },
    }
</script>
