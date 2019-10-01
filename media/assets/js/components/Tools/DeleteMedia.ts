import Vue from "vue"
import {actions, getters} from "../../store"
import {MediaItem} from "../../types"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-delete-media",

    mixins: [Translator],

    methods: {
        onClick(): void {
            Promise.all(this.getRequests())
                .then(() => {
                    actions.loadMediaItems().then(() => {
                        actions.closeActiveMediaTool()
                    })
                })
        },

        getRequests(): Array<any> {
            return this.items.map((item: MediaItem) => actions.deleteMediaItem(item))
        },
    },

    computed: {
        isLoading(): boolean {
            return getters.getLoadingState()
        },

        items(): Array<MediaItem> {
            return getters.getSelectedMediaItems()
        },
    },

    template: `
        <div class="p-3 bg-white">
            <h3>{{ __('Delete') }}</h3>
    
            <ul class="pl-3 mb-0">
                <li v-for="item in items" :key="item.path">
                    {{ item.name }}
                </li>
            </ul>
    
            <div class="text-right">
                <button @click.prevent="onClick" type="button" :disabled="isLoading"
                        class="btn btn-danger">
                    <i class="far fa-fw fa-trash-alt"></i> {{ __(isLoading ? 'Loading...' : 'Delete') }}
                </button>
            </div>
        </div>
    `,
})

