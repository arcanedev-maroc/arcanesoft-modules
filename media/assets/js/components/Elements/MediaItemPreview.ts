import Vue from "vue"
import {MediaItem} from "../../types"
import {getters} from "../../store"

import PreviewNoSelectedMediaItem from "./MediaItemPreviews/NoSelectedMediaItem"
import PreviewSingleMediaItem from "./MediaItemPreviews/SingleMediaItem"
import PreviewMultipleMediaItems from "./MediaItemPreviews/MultipleMediaItems"

export default Vue.extend({
    name: "v-media-item-preview",

    components: {
        PreviewNoSelectedMediaItem,
        PreviewSingleMediaItem,
        PreviewMultipleMediaItems,
    },

    computed: {
        selectedItems(): Array<MediaItem> {
            return getters.getSelectedMediaItems()
        },

        hasSelectedItems(): boolean {
            return getters.getSelectedMediaItemsCount() > 0
        },

        isSingle(): boolean {
            return this.hasSelectedItems && (getters.getSelectedMediaItemsCount() === 1)
        },

        isMultiple(): boolean {
            return this.hasSelectedItems && (getters.getSelectedMediaItemsCount() > 1)
        },

        item(): MediaItem|null {
            if ( ! this.isSingle)
                return null

            return this["selectedItems"][0]
        },
    },

    template: `
        <div class="media-item-preview d-none d-md-block">
            <PreviewNoSelectedMediaItem v-if=" ! hasSelectedItems"/>
            <PreviewSingleMediaItem v-else-if="isSingle" :item="item"/>
            <PreviewMultipleMediaItems v-else-if="isMultiple" :items="selectedItems"/>
        </div>
    `
})


