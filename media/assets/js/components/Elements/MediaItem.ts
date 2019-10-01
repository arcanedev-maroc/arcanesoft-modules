import Vue from "vue"
import {DISPLAY_MODES, MEDIA_TYPES} from "../../enums"
import {actions, getters, mutations} from "../../store"
import {getFileIcon, isImageType} from "../../utilities"
import {MediaItem} from "../../types"

export default Vue.extend({
    name: "media-item",

    props: {
        "item": {
            type: Object,
            required: true,
        },
        "multiple": {
            type: Boolean,
            default: false,
        },
        "selection": {
            type: String,
            default: "any", // "files", "any"
        },
    },

    methods: {
        setSelectedItem(item: MediaItem, event): void {
            if (this.selection === "files" && item.type !== MEDIA_TYPES.FILE)
                return

            if (event.ctrlKey && this.multiple)
                return actions.toggleSelectedMediaItem(item)

            mutations.setSelectedMediaItems([item])
        },

        openItem(item): void {
            if (item.type === MEDIA_TYPES.DIRECTORY)
                actions.changeMediaLocation(item.path)
        },
    },

    computed: {
        iconClass(): string {
            if (this.isDirectory)
                return "fas fa-fw fa-folder"

            return getFileIcon(this.item.mimetype)
        },

        isSelected(): boolean {
            return getters.isSelectedMediaItem(this.item)
        },

        isDirectory(): boolean {
            return this.item.type === MEDIA_TYPES.DIRECTORY
        },

        isFile(): boolean {
            return this.item.type === MEDIA_TYPES.FILE
        },

        isImage(): boolean {
            if ( ! this.isFile)
                return false;

            return isImageType(this.item.mimetype)
        },

        showThumbnail(): boolean {
            return this.isImage
                && getters.getDisplayMode() === DISPLAY_MODES.THUMBNAILS
        },

        thumbnailStyles(): string {
            return `background-image: url("${this.item.url}");`;
        },
    },

    template: `
        <div @click="setSelectedItem(item, $event)"
             @dblclick="openItem(item)"
             class="media-item" :class="{'selected': isSelected}">
            <div v-if="showThumbnail" :style="thumbnailStyles" class="media-item-thumbnail"></div>
            <span v-else class="media-item-icon"><i :class="iconClass"></i></span>
            <span :title="item.name" class="media-item-name">{{ item.name }}</span>
        </div>
    `,
})

