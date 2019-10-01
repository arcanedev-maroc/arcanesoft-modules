import Vue from "vue"
import {actions, getters} from "../../store"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-delete-media-button",

    mixins: [Translator],

    methods: {
        onClick(): void {
            actions.openDeleteMediaTool()
        },
    },

    computed: {
        hasSelectedMedia(): boolean {
            return getters.getSelectedMediaItems().length > 0
        },
    },

    template: `
        <button @click="onClick" :disabled=" ! hasSelectedMedia"
            :title="__('Delete [Del]')"
            class="btn btn-danger">
            <i class="far fa-fw fa-trash-alt"></i>
        </button>
    `,
})
