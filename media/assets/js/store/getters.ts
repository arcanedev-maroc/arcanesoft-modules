import {MEDIA_TOOLS, MEDIA_TYPES} from "../enums"
import state from "./state"
import {MediaItem} from "../types"

export default {
    getCurrentLocation(): string {
        return state.currentLocation
    },

    getLoadingState(): boolean {
        return state.loading
    },

    getActiveMediaTool(): MEDIA_TOOLS|null {
        return state.activeMediaTool
    },

    getMediaItems(): Array<MediaItem> {
        return state.mediaItems
    },

    getDirectories(): Array<MediaItem> {
        return state.mediaItems.filter((item) => item.type === MEDIA_TYPES.DIRECTORY)
    },

    getSelectedMediaItems(): Array<MediaItem> {
        return state.selectedMediaItem
    },

    getSelectedMediaItemsCount(): number {
        return state.selectedMediaItem.length
    },

    isSelectedMediaItem(item: MediaItem): boolean {
        return this.getSelectedMediaItems()
                   .filter((selected) => selected.path === item.path)
                   .length > 0
    },

    getDisplayMode(): string {
        return state.displayMode
    },

    getPreviewMode(): boolean {
        return state.previewMode
    },

    // Counters
    directoriesCount(): number {
        return this.getMediaItems().filter(item => item.type === MEDIA_TYPES.DIRECTORY).length
    },

    filesCount(): number {
        return this.getMediaItems().filter(item => item.type === MEDIA_TYPES.FILE).length
    },
}
