import {DISPLAY_MODES} from "./enums"
import displayModes from "./config/display-modes"

export default {
    baseUrl: "/admin/media/api",

    defaultDisplayMode: DISPLAY_MODES.THUMBNAILS,

    displayModes,

    previewMode: true,

    uppy: {
        core: {
            debug: process.env.NODE_ENV === "development",
            autoProceed: false,
            restrictions: {
                maxFileSize: 5 * 1000 * 1000, // 5 Mo
                maxNumberOfFiles: 10,
                minNumberOfFiles: 1,
                // allowedFileTypes: ["image/*", "video/*"],
            }
        }
    }
}
