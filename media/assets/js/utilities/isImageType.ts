const types = [
    "image/gif",
    "image/jpeg",
    "image/png",
    "image/webp",
    "image/svg+xml",
    "image/svg",
    "image/x-icon",
]

export default function (mimetype: string): boolean {
    return types.includes(mimetype)
}
