import media from "../api/media"
import mutations from "./mutations"
import getters from "./getters"
import {MEDIA_TOOLS} from "../enums"
import {MediaItem} from "../types"

export default {
    // Loading Actions
    startLoadingState(): void {
        mutations.setLoadingState(true)
    },
    stopLoadingState(): void {
        mutations.setLoadingState(false)
    },

    // Medias Actions
    changeMediaLocation(location: string): Promise<any> {
        mutations.setCurrentLocation(location)

        return this.loadMediaItems(location)
    },

    loadMediaItems(location = null): Promise<any> {
        this.startLoadingState()
        this.clearSelectedItems()

        return media.getItems(location || getters.getCurrentLocation())
             .then((response) => {
                 mutations.setMediaItems(response.data)
                 this.stopLoadingState()
             })
    },

    createNewFolder(path: string): Promise<any> {
        this.startLoadingState()

        return media.createNewFolder(path)
    },

    moveMediaItem(destination: string, path: string): Promise<any> {
        return media.moveItem(destination, path)
    },

    renameMediaItem(oldPath: string, newPath: string): Promise<any> {
        this.startLoadingState()

        return media.renameItem(oldPath, newPath)
    },

    deleteMediaItem(item: MediaItem): Promise<any> {
        this.startLoadingState()

        return media.delete(item)
    },

    downloadMediaItem(item: MediaItem): Promise<any> {
        return media.download(item)
    },

    // Selected Medias Actions
    toggleSelectedMediaItem(item: MediaItem): void {
        let items = getters.getSelectedMediaItems();

        if (items.length > 0 && getters.isSelectedMediaItem(item))
            items = items.filter((selected) => selected.path !== item.path)
        else
            items.push(item)

        mutations.setSelectedMediaItems(items)
    },

    clearSelectedItems(): void {
        mutations.setSelectedMediaItems([])
    },

    // Action State Actions
    openDeleteMediaTool(): void {
        if (getters.getSelectedMediaItems().length > 0)
            mutations.setActiveMediaTool(MEDIA_TOOLS.DELETE_MEDIA)
    },

    closeActiveMediaTool(): void {
        mutations.setActiveMediaTool(null)
    },

    // Preview Mode
    togglePreviewMode(): void {
        mutations.setPreviewMode(
            ! getters.getPreviewMode()
        )
    },
}

