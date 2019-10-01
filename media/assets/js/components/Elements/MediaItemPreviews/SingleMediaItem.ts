import Vue from "vue"
import {saveAs} from "file-saver"
import {actions} from "../../../store"
import {Translator} from "../../../mixins"
import {
    getFileIcon,
    getHumanFileSize,
    isImageType,
    isMediaDirectoryType,
    isMediaFileType,
    isVideoType
} from "../../../utilities"

export default Vue.extend({
    name: "v-preview-single-media-item",

    mixins: [Translator],

    props: {
        item: {
            type: Object,
            required: true,
        },
    },

    watch: {
        item() {
            let video = <HTMLMediaElement>document.querySelector('.item-preview-video video')

            if (video)
                video.load()
        },
    },

    computed: {
        isDirectory(): boolean {
            return isMediaDirectoryType(this.item)
        },

        isFile(): boolean {
            return isMediaFileType(this.item);
        },

        humanFileSize(): string {
            return getHumanFileSize(this.item.size)
        },

        isImage(): boolean {
            return this.isFile
                ? isImageType(this.item.mimetype)
                : false
        },

        isVideo(): boolean {
            return this.isFile
                ? isVideoType(this.item.mimetype)
                : false
        },

        iconClass(): string {
            if (this.isDirectory)
                return 'fa fa-fw fa-folder'

            return getFileIcon(this.item.mimetype)
        },
    },

    methods: {
        download(): void {
            actions.downloadMediaItem(this.item)
                .then((response) => {
                    saveAs(response.data, this.item.name)
                })
        },
    },

    template: `
        <div>
            <div v-if="isImage" :style="'background-image: url('+item.url+');'" class="item-preview-thumbnail"></div>
            <div v-else-if="isVideo" class="item-preview-video">
                <video controls controlsList="nodownload">
                    <source :src="item.url" :type="item.mimetype">
                    Sorry, your browser doesn't support embedded videos.
                </video>
            </div>
            <div v-else class="item-preview-icon d-flex justify-content-center">
                <i class="fa-5x" :class="iconClass"></i>
            </div>
    
            <table class="item-preview-table table table-md table-borderless mb-0">
                <tbody>
                <tr>
                    <th class="text-muted">{{ __('Name') }}:</th>
                    <td class="text-right">{{ item.name }}</td>
                </tr>
                <tr>
                    <th class="text-muted">{{ __('Path') }}:</th>
                    <td class="text-right small">/{{ item.path }}</td>
                </tr>
                <tr v-if="isFile">
                    <th class="text-muted">{{ __('Size') }}:</th>
                    <td class="text-right">{{ humanFileSize }}</td>
                </tr>
                <tr v-if="isFile">
                    <th class="text-muted">{{ __('Type') }}:</th>
                    <td class="text-right">{{ item.mimetype }}</td>
                </tr>
                <tr v-if="isFile">
                    <th class="text-muted">{{ __('Visibility') }}:</th>
                    <td class="text-right">{{ item.visibility }}</td>
                </tr>
                <tr>
                    <th class="text-muted">{{ __('URL') }}:</th>
                    <td class="text-right">
                        <a :href="item.url" target="_blank">Preview</a>
                    </td>
                </tr>
                <tr v-if="isFile">
                    <th class="text-muted">{{ __('Last modified') }}:</th>
                    <td class="text-right small">{{ item.lastModified }}</td>
                </tr>
                </tbody>
                <tfoot v-if="isFile">
                <tr>
                    <td colspan="2">
                        <button @click.prevent="download" class="btn btn-block btn-light">
                            <i class="fa fa-fw fa-download"></i> {{ __('Download') }}
                        </button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    `,
})
