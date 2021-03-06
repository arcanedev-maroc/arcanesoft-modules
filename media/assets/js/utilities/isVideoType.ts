const types = [
    "video/avi",
    "video/ogg",
    "video/mp4",
    "video/mpeg",
    "video/webm",
    "video/quicktime",
]

export default function (mimetype: string): boolean {
    return types.includes(mimetype)
}
