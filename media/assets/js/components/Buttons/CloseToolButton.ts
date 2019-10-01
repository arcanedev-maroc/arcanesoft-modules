import Vue from "vue";
import {actions} from "../../store";
import {Translator} from "../../mixins";

export default Vue.extend({
    name: "v-close-tool-button",

    mixins: [Translator],

    methods: {
        onClick(): void {
            actions.closeActiveMediaTool()
        },
    },

    template: `
        <button @click.prevent="onClick" class="btn btn-secondary">
            <i class="fas fa-fw fa-times"></i> {{ __('Close') }}
        </button>
    `,
})
