import {MediaItem} from "../types"
import {MEDIA_TYPES} from "../enums"

export default function (media: MediaItem): boolean {
    return media.type === MEDIA_TYPES.DIRECTORY
}

