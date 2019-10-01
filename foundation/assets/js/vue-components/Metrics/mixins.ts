import {merge as _merge} from 'lodash'

const config = {
    endpoint: '/admin/metrics/process'
}

const mixins = {
    props: {
        metric: {
            type: Object,
            required: true,
        }
    },

    data: () => ({
        loading: true,
        allowed: true,
        result: {},
    }),

    methods: {
        fetch(metric, options = {}) {
            this.loading = true;

            options = _merge(options, {
                params: {metric}
            })

            return window['Foundation'].request().get(config.endpoint, options)
                .then((response) => {
                    this.result  = response.data
                    this.loading = false

                    return response;
                })
                .catch(({response}) => {
                    if (response && response.status === 403)
                        this.allowed = false

                    this.loading = false
                })
        }
    },

    computed: {
        isLoading() {
            return this.loading
        },

        isReady() {
            return ! this.isLoading
        },

        isAllowed() {
            return this.allowed
        },

        isNotAllowed() {
            return ! this.isAllowed
        },
    }
}

export default mixins
