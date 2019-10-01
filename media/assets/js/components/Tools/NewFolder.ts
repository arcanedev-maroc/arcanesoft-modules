import Vue from "vue"
import {actions, getters} from "../../store"
import {Translator} from "../../mixins"

export default Vue.extend({
    name: "v-new-folder",

    mixins: [Translator],

    data: () => ({
        name: '',
        errors: {},
    }),

    created() {
        this.resetErrors()
    },

    methods: {
        onSubmit(): void {
            this.resetErrors()

            actions.createNewFolder(this.path)
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
                name: []
            }
        },
    },

    computed: {
        isLoading(): boolean {
            return getters.getLoadingState()
        },

        currentLocation(): string {
            return getters.getCurrentLocation().replace(/^\/+/, '') + '/'
        },

        nameError(): string | null {
            return this.errors['name'][0] || null
        },

        hasNameError(): boolean {
            return this.nameError !== null
        },

        path(): string {
            let location = getters.getCurrentLocation();

            return location === '/' ? this.name : `${location}/${this.name}`
        },
    },

    template: `
        <div class="bg-white p-3">
            <label for="name">{{ __('New Folder') }}</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">{{ currentLocation }}</span>
                </div>
                <input v-model="name"
                       id="name" type="text" required
                       class="form-control" :class="{'is-invalid': hasNameError}" :readonly="isLoading"
                       aria-describedby="nameHelpBlock">
                <div class="input-group-append">
                    <button @click.prevent="onSubmit" :disabled="isLoading"
                            class="btn btn-primary" type="button">{{ __(isLoading ? 'Loading...' : 'Create') }}</button>
                </div>
                <div class="invalid-feedback" v-if="hasNameError">
                    {{ nameError }}
                </div>
            </div>
            <small id="nameHelpBlock" class="form-text text-muted">
                The name folder must be all in lowercase without special characters and separated with \`-\` (dash) instead for spaces.
            </small>
        </div>
    `,
})
