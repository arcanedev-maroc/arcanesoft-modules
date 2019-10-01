import Vue from "vue"
import {EVENTS} from "../enums"
import {actions, getters} from "../store"
import {Translator} from "../mixins"

import {
    MediaToolbar,
    MediaBreadcrumbs,
    MediaItemsContainer,
    MediaItemPreview,
    MediaItemTools,
} from "./Elements"

export default Vue.extend({
    name: "v-media-manager",

    mixins: [Translator],

    components: {
        MediaBreadcrumbs,
        MediaToolbar,

        MediaItemsContainer,
        MediaItemPreview,

        MediaItemTools,
    },

    data: () => ({
        newFolderShow: false,
        filesUploaderShown: false,
    }),

    mounted(): void {
        actions.loadMediaItems()

        window.addEventListener('keyup', (event) => {
            window['Foundation'].$emit(EVENTS.KEYBOARD_EVENT_KEYUP, event)
        })
    },

    computed: {
        currentLocation(): string {
            return getters.getCurrentLocation()
        },

        isLoading(): boolean {
            return getters.getLoadingState()
        },

        isPreviewModeEnabled(): boolean {
            return getters.getPreviewMode()
        },

        // MEDIA TOOLS
        hasActiveAction(): boolean {
            return getters.getActiveMediaTool() !== null
        },

        // STATUS BAR
        mediaItemsCount(): number {
            return getters.getMediaItems().length
        },

        directoriesCount(): number {
            return getters.directoriesCount()
        },

        filesCount(): number {
            return getters.filesCount()
        },
    },

    template: `
        <div class="media-manager shadow-sm mb-3">
            <div class="media-manager-loading" v-if="isLoading"></div>

            <div class="media-manager-header">
                <MediaToolbar/>
                <MediaBreadcrumbs v-if=" ! hasActiveAction"/>
            </div>

            <MediaItemTools />

            <div v-if=" ! hasActiveAction" class="media-manager-body">
                <MediaItemsContainer/>
                <MediaItemPreview v-if="isPreviewModeEnabled"/>
            </div>
            <div v-if=" ! hasActiveAction" class="media-manager-footer">
                <span class="small">{{ __('Total :count item(s)', {count: mediaItemsCount}) }} | {{ __(':count Directories', {count: directoriesCount}) }} - {{ __(':count Files', {count: filesCount}) }}</span>
            </div>
        </div>
    `,
})
