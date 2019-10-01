import Vue from "vue"
import {actions, getters} from "../../store"
import {MediaItem} from "../../types"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-rename-media-item",

    mixins: [Translator],

    data: () => ({
        name: null,
        errors: {},
    }),

    created(): void {
        this.resetErrors()

        this.name = this.item.name
    },

    methods: {
        onSubmit(): void {
            this.resetErrors()

            actions.renameMediaItem(this.item.path, this.newPath)
                .then((response) => {
                    if (response.status === 200) {
                        actions.closeActiveMediaTool()
                        actions.loadMediaItems()
                    }
                })
                .catch((error) => {
                    if (error.response && error.response.status === 422)
                        this.errors = error.response.data.errors || {}

                    actions.stopLoadingState()
                })
        },

        resetErrors(): void {
            this.errors = {
                'new_name': []
            }
        },
    },

    computed: {
        isLoading(): boolean {
            return getters.getLoadingState()
        },

        item(): MediaItem {
            return getters.getSelectedMediaItems()[0]
        },

        hasChanged(): boolean {
            return this.name !== this.item.name
        },

        nameError(): string|null {
            return this.errors['new_name'][0] || null
        },

        hasNameError(): boolean {
            return this.nameError !== null
        },

        newPath(): string {
            let location = getters.getCurrentLocation()

            return location === '/' ? this.name : `${location}/${this.name}`;
        },
    },

    template: `
        <div class="bg-white p-3">
            <label for="name">{{ __('Rename') }}</label>
            <div class="input-group">
                <input type="text" v-model="name" @keyup.enter="onSubmit" id="name" required
                       class="form-control" :class="{'is-invalid': hasNameError}" :readonly="isLoading">
                <div class="input-group-append">
                    <button @click.prevent="onSubmit" :disabled=" ! this.hasChanged || isLoading"
                            class="btn btn-warning" type="button">{{ __(isLoading ? 'Loading...' : 'Rename') }}</button>
                </div>
                <div class="invalid-feedback" v-if="hasNameError">
                    {{ nameError }}
                </div>
            </div>
        </div>
    `,
})
