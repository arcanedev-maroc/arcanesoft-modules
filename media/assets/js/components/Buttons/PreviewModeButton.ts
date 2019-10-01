import Vue from "vue"
import {actions, getters} from "../../store"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-preview-mode-button",

    mixins: [Translator],

    methods: {
        toggle(): void {
            actions.togglePreviewMode()
        },
    },

    computed: {
        isActive(): boolean {
            return getters.getPreviewMode()
        },
    },

    template: `
        <button @click="toggle" :title="__('Preview Mode')"
            class="btn btn-light" :class="{'active': isActive}"
            type="button">
            <i class="fas fa-fw fa-info-circle"></i>
        </button>
    `,
})
