<template>
    <div class="toasts-container">
        <toast-component v-for="toast in toasts" :key="toast.id" :toast="toast" />
    </div>
</template>

<script>
    import ToastComponent from "./ToastComponent"
    import Toast from "./Toast"
    import events from "./events"

    export default {
        name: "toasts-manager-component",

        register: true,

        components: {
            "toast-component": ToastComponent
        },

        data: () => ({
            toasts: [],
        }),

        mounted() {
            window["Foundation"].$on(events.UI_TOASTS_NOTIFY, ({type, title, body, options}) => {
                this.pushToast(type, title, body, options || {})
            })

            window["Foundation"].$on(events.UI_TOASTS_HIDDEN, (toast) => {
                this.removeToast(toast)
            })
        },

        destroyed() {
            window["Foundation"].$off(events.UI_TOASTS_NOTIFY)
            window["Foundation"].$off(events.UI_TOASTS_HIDDEN)
        },

        methods: {
            pushToast(type, title, body, options) {
                this.toasts.push(
                    Toast.make(
                        type,
                        title,
                        body,
                        options.time || Date.now(),
                        options.delay || 5000
                    )
                )
            },

            removeToast(toast) {
                this.toasts = this.toasts.filter((t) => t.id !== toast.id)
            },
        },
    }
</script>

<style lang="scss" scoped>
    .toasts-container {
        position: fixed;
        bottom: 1rem;
        right: 1rem;
    }
</style>
