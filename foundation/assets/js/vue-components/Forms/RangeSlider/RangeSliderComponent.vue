<template>
    <div>
        <input type="hidden" :name="name" :value="values">
        <div ref="rangeSlider"></div>
    </div>
</template>

<script lang="ts">
    import noUiSlider from 'nouislider'

    export default {
        name: "range-slider-component",

        register: true,

        props: {
            name: {
                type: String,
                required: true,
            },

            start: {
                required: true,
            },

            min: {
                required: true,
            },

            max: {
                required: true,
            },

            step: {
                type: Number,
                default: null,
            },

            options: {
                type: Object,
                default: () => {},
            },
        },

        data: () => ({
            values: null,
            slider: null,
        }),

        mounted() {
            this.slider = noUiSlider.create(this.$refs.rangeSlider, {
                ...this.getOptions(),
                ...this.options,
            })

            this.slider.on('update', (values, handle) => {
                this.setValues(values)
            })
        },

        methods: {
            setValues(values) {
                this.values = values
            },

            getOptions() {
                return {
                    start: this.start,
                    range: {
                        min: this.min,
                        max: this.max
                    },
                    step: this.step,
                    connect: true,
                }
            }
        }
    }
</script>
