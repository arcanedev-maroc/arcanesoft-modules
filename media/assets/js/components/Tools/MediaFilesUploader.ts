import Vue from "vue"
import {merge as _merge} from "lodash"
import {Core, Dashboard, XHRUpload} from 'uppy'

import config from "../../config"
import {EVENTS} from "../../enums"
import {getters, actions} from "../../store"
import {Translator} from "../../mixins"
import Csrf from '@arcanesoft/helpers/js/Utilities/Misc/Csrf'

export default Vue.extend({
    name: "media-files-uploader",

    mixins: [Translator],

    data: () => ({
        uppy: null,
        uploading: false,
        filesUploaded: false,
    }),

    mounted(): void {
        window['ready'](() => {
            this.uppy = this.createUppy()
        })

        window['Foundation'].$on(EVENTS.KEYBOARD_EVENT_KEYUP, (event) => {
            if (event.code === 'Escape' && ! this.uploading)
                actions.closeActiveMediaTool()
        })
    },

    destroyed(): void {
        if (this.uppy)
            this.destroyUppy()

        if (this.filesUploaded)
            actions.loadMediaItems()
    },

    methods: {
        createUppy() {
            return Core(this.uppyCoreOptions)
                .use(Dashboard, this.uppyDashboardOptions)
                .use(XHRUpload, this.uppyXHRUploadOptions)
                .on('upload', (data) => {
                    this.uploading = true
                })
                .on('complete', (result) => {
                    this.uploading = false
                    this.filesUploaded = true
                })
        },

        destroyUppy(): void {
            this.uppy.close()
            this.uppy = null
        },
    },

    computed: {
        // Uppy Options
        uppyCoreOptions(): Object {
            return _merge(config.uppy.core, {
                meta: {
                    location: getters.getCurrentLocation(),
                },
            })
        },

        uppyDashboardOptions(): Object {
            return {
                target: this.$refs.mediaFilesUploader,
                inline: true,
                width: '100%',
                height: 300,
                replaceTargetContent: true,
                showProgressDetails: true,
                browserBackButtonClose: true,
                proudlyDisplayPoweredByUppy: false,
            }
        },

        uppyXHRUploadOptions(): Object {
            return {
                endpoint: `${config.baseUrl}/upload`,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': Csrf.token(),
                },
                formData: true,
                bundle: false,
            }
        },
    },

    template: `
        <div>
            <label class="checkbox-inline">
                <input type="checkbox" name="hash_name" id="hash-name" value="1"> Hash names
            </label>
    
            <div ref="mediaFilesUploader" class="media-files-uploader"></div>
        </div>
    `,
})
