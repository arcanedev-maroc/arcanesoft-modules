import Vue from "vue"
import {getters} from "../store"
import {MediaItem} from "../types"
import {Translator} from "../mixins"

import {
    MediaToolbar,
    MediaBreadcrumbs,
    MediaItemsContainer
} from "./Elements"

export default Vue.extend({
    name: "v-media-browser",

    mixins: [Translator],

    data: () => ({
        modal: null,
        urls: null,
    }),

    props: {
        multiple: {
            type: Boolean,
            default: false,
        },
    },

    components: {
        MediaToolbar,
        MediaBreadcrumbs,
        MediaItemsContainer,
    },

    methods: {
        openBrowser() {
            this.modal = window['$'](this.$refs.browserModal).modal('show')
                .on('hidden.bs.modal', () => {
                    this.modal = null
                })
        },

        select() {
            this.urls = this.selectedItems.map((item: MediaItem) => item.url).join(", ")

            this.modal.modal('hide')
        },
    },

    computed: {
        selectedItems(): Array<MediaItem> {
            return getters.getSelectedMediaItems()
        },

        isModalOpen(): boolean {
            return this.modal !== null
        },
    },

    template: `
        <div>
            <div class="input-group mb-3">
                <input v-model="urls" type="text" class="form-control">
                <div class="input-group-append">
                    <button @click="openBrowser"
                            class="btn btn-outline-secondary" type="button">{{ __('Browse') }}</button>
                </div>
            </div>

            <div ref="browserModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div v-if="isModalOpen" class="media-browser">
                                <div class="media-manager-header">
                                    <MediaToolbar :readonly="true"/>
                                    <MediaBreadcrumbs/>
                                </div>
                                <div class="media-manager-body">
                                    <MediaItemsContainer selection="files" :multiple="multiple" :readonly="true"/>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                            <button @click="select"
                                    type="button" class="btn btn-primary">{{ __('Select') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    `,
})
