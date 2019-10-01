import Vue from "vue"
import {MEDIA_TOOLS} from "../../enums"
import {getters, mutations} from "../../store"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-move-media-button",

    mixins: [Translator],

    methods: {
        onClick(): void {
            if (this.hasSelectedMedia)
                mutations.setActiveMediaTool(MEDIA_TOOLS.MOVE_MEDIA)
        },
    },

    computed: {
        hasSelectedMedia(): boolean {
            return getters.getSelectedMediaItems().length > 0
        },
    },

    template: `
        <button @click="onClick" :disabled=" ! hasSelectedMedia"
            class="btn btn-primary" :title="__('Move')">
            <i class="fas fa-fw fa-dolly"></i>
        </button>
    `,
})
