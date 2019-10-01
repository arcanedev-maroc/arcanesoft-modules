import Vue from "vue"
import {MEDIA_TOOLS} from "../../enums"
import {mutations} from "../../store"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-open-file-uploader-button",

    mixins: [Translator],

    methods: {
        onClick(): void {
            mutations.setActiveMediaTool(MEDIA_TOOLS.FILE_UPLOADER)
        },
    },

    template: `
        <button @click.prevent="onClick" class="btn btn-light">
            <i class="fas fa-fw fa-upload"></i> {{ __('Upload') }}
        </button>
    `,
})
