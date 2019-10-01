<template>
    <div class="toast fade" :class="toastClasses" role="alert" aria-live="assertive" aria-atomic="true" :data-delay="toast.delay">
        <div class="toast-header">
            <strong class="mr-auto">{{ toast.title }}</strong>
            <button type="button" class="ml-2 mb-1 close" aria-label="Close" data-dismiss="toast">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body" v-if="toast.body" v-html="toast.body"></div>
        <div class="toast-footer">
            <small class="text-muted">{{ formattedTime }}</small>
        </div>
    </div>
</template>

<script lang="ts">
    import Vue from "vue"
    import * as moment from "moment"
    import Toast from "./Toast"
    import events from "./events"
    import Types from "./types"

    export default Vue.extend({
        props: {
            toast: {
                type: Object as () => Toast,
                required: true,
            }
        },

        mounted() {
            window['$'](this.$el).toast('show').on('hidden.bs.toast', () => {
                window['Foundation'].$emit(events.UI_TOASTS_HIDDEN, this.toast)
            })
        },

        computed: {
            toastClasses() {
                let classes: string[] = [];

                if (Object.values(Types).includes(this.toast.type))
                    classes.push(`toast-${this.toast.type}`)

                return classes.join(' ')
            },

            formattedTime() {
                return moment(this.toast.time).fromNow()
            },
        },
    })
</script>
