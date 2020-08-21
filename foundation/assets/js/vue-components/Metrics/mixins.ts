import config from './config'
import {request} from '../../mixins'

export default {
    props: {
        metric: {
            type: Object,
            required: true,
        },
    },

    mixins: [
        request,
    ],

    data: (): Object => ({
        loading: true,
        allowed: true,
        result: {},
    }),

    methods: {
        fetch(metric, options = {}): Promise<any> {
            this.loading = true;

            options = window['_'].merge(options, {
                params: {metric}
            })

            return this.request()
                .get(config.endpoint, options)
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
        isLoading(): boolean {
            return this.loading
        },

        isReady(): boolean {
            return ! this.isLoading
        },

        isAllowed(): boolean {
            return this.allowed
        },

        isNotAllowed(): boolean {
            return ! this.isAllowed
        },
    },
}
