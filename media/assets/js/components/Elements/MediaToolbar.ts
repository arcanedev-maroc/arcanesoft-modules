import Vue from "vue"
import config from "../../config"
import {getters} from "../../store";

import {
    CloseToolButton,
    OpenFileUploaderButton,
    NewFolderButton,
    RefreshButton,
    MoveMediaButton,
    RenameMediaButton,
    DeleteMediaButton,
    DisplayModeButton,
    PreviewModeButton,
} from "../Buttons"

export default Vue.extend({
    name: "v-media-manager-toolbar",

    props: {
        "readonly": {
            type: Boolean,
            default: false,
        },
    },

    components: {
        CloseToolButton,

        OpenFileUploaderButton,
        NewFolderButton,

        RefreshButton,

        DisplayModeButton,
        PreviewModeButton,

        MoveMediaButton,
        RenameMediaButton,
        DeleteMediaButton,
    },

    data: () => ({
        modes: [],
    }),

    created(): void {
        this.modes = config.displayModes
    },

    computed: {
        hasActiveMediaTool(): boolean {
            return getters.getActiveMediaTool() !== null
        },
    },

    template: `
        <div class="media-manager-toolbar" v-if=" ! hasActiveMediaTool">
            <div v-if=" ! readonly" class="btn-group" role="group">
                <OpenFileUploaderButton/>
                <NewFolderButton/>
            </div>
    
            <RefreshButton class="ml-1"/>
    
            <div v-if=" ! readonly" class="btn-group ml-1" role="group">
                <MoveMediaButton/>
                <RenameMediaButton/>
                <DeleteMediaButton/>
            </div>
    
            <div class="btn-group display-modes ml-auto" role="group" aria-label="Display Mode">
                <DisplayModeButton v-for="mode in modes" :key="mode.key" :mode="mode"/>
            </div>
    
            <PreviewModeButton v-if=" ! readonly" class="ml-1 d-none d-md-block"/>
        </div>
    
        <div class="media-manager-toolbar" v-else>
            <CloseToolButton />
        </div>
    `,
})
