import Vue from "vue"
import {MEDIA_TYPES} from "../../enums"
import {actions, getters} from "../../store"
import {MediaItem} from "../../types"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-move-media",

    mixins: [Translator],

    data: () => ({
        destination: null,
        directories: [],
        results: [],
    }),

    created(): void {
        this.directories = getters.getDirectories()
    },

    methods: {
        onClick(): void {
            if ( ! this.hasSelectedDestination)
                return

            actions.startLoadingState()

            Promise.all(this.getRequests()).then(() => {
                actions.loadMediaItems().then(() => { actions.closeActiveMediaTool() })
            })
        },

        getRequests(): Array<any> {
            return this.items.map(
                (item: MediaItem) => actions.moveMediaItem(this.destination, item.path)
                    .then(response => {
                        this.results.push({
                            item,
                            status: response.status === 200 ? "success" : "failed",
                        })
                    })
            )
        },
    },

    computed: {
        isLoading(): boolean {
            return getters.getLoadingState()
        },

        hasSelectedDestination(): boolean {
            return this.destination !== null
        },

        showParentDestination(): boolean {
            return getters.getCurrentLocation() !== "/"
        },

        destinations(): Array<MediaItem> {
            const destinationsToExclude = this.items
                .filter((item: MediaItem) => item.type === MEDIA_TYPES.DIRECTORY)
                .map((item: MediaItem) => item.name)

            return this.directories.filter((item: MediaItem) => ! destinationsToExclude.includes(item.name));
        },

        items(): Array<MediaItem> {
            return getters.getSelectedMediaItems()
        },
    },

    template: `
        <div class="bg-white p-3">
            <label for="destination">{{ __('Select a Destination') }}</label>
            <div class="input-group mb-3">
                <select v-model="destination" id="destination" class="form-control" :readonly="isLoading">
                    <option value=".." v-if="showParentDestination">..</option>
                    <option v-for="destination in destinations"
                            :value="destination.name"
                            v-text="destination.name"></option>
                </select>
                <div class="input-group-append">
                    <button @click.prevent="onClick"
                            class="btn btn-primary" type="button"
                            :disabled="isLoading || ! hasSelectedDestination">
                        {{ __(isLoading ? "Loading..." : "Move") }}
                    </button>
                </div>
            </div>
    
            <ul class="pl-3 mb-0">
                <li v-for="item in items" :key="item.path">{{ item.name }}</li>
            </ul>
        </div>
    `,
})

