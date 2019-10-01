import Vue from "vue"
import {mutations, getters} from "../../store"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-display-mode-button",

    mixins: [Translator],

    props: {
        mode: {
            type: Object,
            required: true,
        },
    },

    methods: {
        changeDisplayMode(): void {
            if ( ! this.selected)
                mutations.setDisplayMode(this.mode.key)
        },
    },

    computed: {
        selected(): boolean {
            return this.mode.key === getters.getDisplayMode()
        },
    },

    template: `
        <button @click.prevent="changeDisplayMode" :title="__(mode.title)"
            class="display-mode btn btn-light" :class="{'active': selected}"
            type="button">
            <i :class="mode.icon"></i>
        </button>
    `,
})
