import MEDIA_TYPES from "./enums/MEDIA_TYPES"

export type MediaItem = {
    type: MEDIA_TYPES,
    name: string,
    path: string,
    url?: string,
    mimetype?: string,
    lastModified?: string,
    visibility?: string,
    size?: number,
}
