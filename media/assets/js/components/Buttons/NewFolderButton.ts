import Vue from "vue"
import {MEDIA_TOOLS} from "../../enums"
import {mutations} from "../../store"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-new-folder-button",

    mixins: [Translator],

    methods: {
        onClick(): void {
            mutations.setActiveMediaTool(MEDIA_TOOLS.NEW_FOLDER)
        },
    },

    template: `
        <button @click="onClick" type="button" class="btn btn-light">
            <i class="fas fa-fw fa-folder-plus"></i> {{ __('New Folder') }}
        </button>
    `,
})
