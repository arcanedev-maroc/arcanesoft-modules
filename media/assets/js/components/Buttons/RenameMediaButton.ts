import Vue from "vue"
import {MEDIA_TOOLS} from "../../enums"
import {getters, mutations} from "../../store"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-rename-media-button",

    mixins: [Translator],

    methods: {
        onClick(): void {
            if (this.hasSelectedMedia)
                mutations.setActiveMediaTool(MEDIA_TOOLS.RENAME_MEDIA)
        },
    },

    computed: {
        hasSelectedMedia(): boolean {
            return getters.getSelectedMediaItems().length === 1
        },
    },

    template: `
        <button @click="onClick" :disabled=" ! hasSelectedMedia"
            class="btn btn-warning" :title="__('Rename')">
            <i class="fas fa-fw fa-i-cursor"></i>
        </button>
    `,
})
