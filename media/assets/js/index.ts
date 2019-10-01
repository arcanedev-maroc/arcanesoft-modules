import MediaManager from "./components/MediaManager"
import MediaBrowser from "./components/MediaBrowser"

export default {
    install(Vue) {
        Vue.component("v-media-manager", MediaManager)
        Vue.component("v-media-browser", MediaBrowser)
    }
}
