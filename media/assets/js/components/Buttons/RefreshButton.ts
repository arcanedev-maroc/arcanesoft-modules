import Vue from "vue"
import {actions, getters} from "../../store"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-refresh-button",

    mixins: [Translator],

    methods: {
        reloadCurrentLocation(): void {
            actions.loadMediaItems()
        },
    },

    computed: {
        isLoading(): boolean {
            return getters.getLoadingState()
        },
    },

    template: `
        <button @click="reloadCurrentLocation" :disabled="isLoading"
                type="button" class="btn btn-light" :title="__('Refresh [R]')">
            <i class="fas fa-fw fa-sync-alt" :class="{'fa-spin': this.isLoading}"></i>
        </button>
    `,
})

