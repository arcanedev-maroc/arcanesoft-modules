import Vue from "vue"
import {MEDIA_TOOLS} from '../../enums'
import {getters} from "../../store"

import {
    NewFolder,
    MediaFilesUploader,
    MoveMedia,
    RenameMedia,
    DeleteMedia,
} from "../Tools"

export default Vue.extend({
    name: "v-media-items-tools",

    components: {
        NewFolder,
        MediaFilesUploader,

        MoveMedia,
        RenameMedia,
        DeleteMedia,
    },

    computed: {
        activeTool(): string|null {
            return getters.getActiveMediaTool()
        },

        hasActiveTool(): boolean {
            return this.activeTool !== null
        },

        activeToolIsFileUploader(): boolean {
            return this.checkToolIsActive(MEDIA_TOOLS.FILE_UPLOADER)
        },

        activeToolIsNewFolder(): boolean {
            return this.checkToolIsActive(MEDIA_TOOLS.NEW_FOLDER)
        },

        activeToolIsMoveMedia(): boolean {
            return this.checkToolIsActive(MEDIA_TOOLS.MOVE_MEDIA)
        },

        activeToolIsRenameMedia(): boolean {
            return this.checkToolIsActive(MEDIA_TOOLS.RENAME_MEDIA)
        },

        activeToolIsDeleteMedia(): boolean {
            return this.checkToolIsActive(MEDIA_TOOLS.DELETE_MEDIA)
        },
    },

    methods: {
        checkToolIsActive(tool: MEDIA_TOOLS): boolean {
            return this.activeTool === tool
        }
    },

    template: `
        <div v-if="hasActiveTool">
            <MediaFilesUploader v-if="activeToolIsFileUploader"/>
            <NewFolder v-if="activeToolIsNewFolder"/>
    
            <MoveMedia v-if="activeToolIsMoveMedia"/>
            <RenameMedia v-if="activeToolIsRenameMedia"/>
            <DeleteMedia v-if="activeToolIsDeleteMedia"/>
        </div>
    `,
})
