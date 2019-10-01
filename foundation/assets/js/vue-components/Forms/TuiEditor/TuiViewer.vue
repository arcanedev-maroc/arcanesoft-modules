<template>
    <div ref="tuiViewer"></div>
</template>

<script lang="ts">
    import Editor from 'tui-editor'

    export default {
        name: "tui-viewer",

        register: true,

        props: {
            value: {
                type: String,
                default: null,
            },

            height: {
                type: String,
                default: '300px',
            }
        },

        mounted() {
            const options = {
                ...{
                    el: this.$refs.tuiViewer,
                    height: this.height,
                    initialValue: this.value,
                    viewer: true,
                }
            };

            this.editor = Editor.factory(options)
        },
    }
</script>
