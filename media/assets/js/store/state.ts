import Vue from "vue"
import config from "../config"

export default Vue.observable({

    loading: false,

    currentLocation: "/",

    displayMode: config.defaultDisplayMode,

    previewMode: config.previewMode,

    mediaItems: [],

    selectedMediaItem: [],

    activeMediaTool: null,

})
