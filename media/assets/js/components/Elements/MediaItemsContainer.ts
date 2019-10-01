import Vue from "vue"

import {EVENTS, DISPLAY_MODES} from "../../enums"
import {actions, getters} from "../../store"
import { MediaItem } from "../../types"

import MediaItemComponent from "./MediaItem"

export default Vue.extend({
    name: "v-media-items-container",

    components: {
        MediaItemComponent,
    },

    props: {
        "multiple": {
            type: Boolean,
            default: false,
        },
        "readonly": {
            type:    Boolean,
            default: false
        },
        "selection": {
            type: String,
            default: "any",
        },
    },

    data: () => ({
        selected: null,
    }),

    mounted(): void {
        window["Foundation"].$on(EVENTS.KEYBOARD_EVENT_KEYUP, (event) => {
            if (event.code === "Delete")
                actions.openDeleteMediaTool()

            if (event.code === "Escape")
                actions.clearSelectedItems()

            if (event.code === "KeyR" && ! this.hasActiveMediaTool)
                actions.loadMediaItems()
        })
    },

    methods: {
        isCurrentDisplayModeSelected(mode: DISPLAY_MODES): boolean {
            return getters.getDisplayMode() === mode
        },
    },

    computed: {
        mediaItems(): MediaItem[] {
            return getters.getMediaItems()
        },

        isPreviewModeEnabled(): boolean {
            return getters.getPreviewMode()
        },

        hasActiveMediaTool(): boolean {
            return getters.getActiveMediaTool() !== null
        },

        mediaItemsContainerClasses() {
            return {
                "display-mode-grid":       this.isCurrentDisplayModeSelected(DISPLAY_MODES.GRID),
                "display-mode-icons":      this.isCurrentDisplayModeSelected(DISPLAY_MODES.ICONS),
                "display-mode-list":       this.isCurrentDisplayModeSelected(DISPLAY_MODES.LIST),
                "display-mode-thumbnails": this.isCurrentDisplayModeSelected(DISPLAY_MODES.THUMBNAILS),
                "with-preview-mode":       ! this.readonly && this.isPreviewModeEnabled,
            }
        },
    },

    template: `
        <div class="media-items-container" :class="mediaItemsContainerClasses">
            <MediaItemComponent
                v-for="item in mediaItems"
                :item="item" :key="item.path"
                :selection="selection" :multiple="multiple"/>
        </div>
    `,
})
