<template>
    <div class="vue-rating">
        <label v-for="rating in ratingRange"
               @click="setSelected(rating)" @mouseover="starOver(rating)" @mouseout="starOut"
               class="vue-rating-label" :class="ratingClasses(rating)">
            <input type="radio" class="vue-rating-input"
                   v-model="selectedValue"
                   :value="rating" :id="name+'-'+rating" :name="name"
                   :disabled="disabled" :readonly="readonly">
            <i :class="icon"></i>
        </label>
    </div>
</template>

<script lang="ts">
    import {range as _range} from "lodash"

    export default {
        name: "rating-input-component",

        register: true,

        props: {
            name: {
                type: String,
                required: false,
                default: "rating",
            },
            value: {
                default: null,
            },
            max: {
                type: Number,
                required: false,
                default: 5,
            },
            icon: {
                type: String,
                required: false,
                default: "fa fa-fw fa-star",
            },
            readonly: {
                type: Boolean,
                required: false,
                default: false,
            },
            disabled: {
                type: Boolean,
                required: false,
                default: false,
            },
        },

        /*
         * Initial state of the component's data.
         */
        data() {
            return {
                selectedValue: null,
                oldValue: null,
            };
        },

        mounted() {
            this.selectedValue = this.value
        },

        methods: {
            starOver(value) {
                if (this.isDisabled)
                    return

                this.oldValue = this.selectedValue
                this.selectedValue = value
            },

            starOut() {
                if (this.isDisabled)
                    return

                this.selectedValue = this.oldValue
            },

            setSelected(value) {
                if (this.isDisabled)
                    return

                this.oldValue = value
                this.selectedValue = value
            }
        },

        computed: {
            ratingRange() {
                return _range(1, this.max + 1)
            },

            isDisabled() {
                return this.disabled
            },

            ratingClasses() {
                return (rating) => {
                    return {
                        'is-selected': (this.selectedValue >= rating) && this.selectedValue != null,
                        'is-disabled': this.disabled,
                    }
                }
            },
        },
    }
</script>

<style lang="scss" scoped>
    .vue-rating {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    .vue-rating-label {
        margin-bottom: 0;
        line-height: 1;
        font-size: 1.5em;
        color: #ABABAB;
        transition: color .2s ease-out;

        &:hover {
            cursor: pointer;
        }

        &.is-selected {
            color: #FFD700;
        }

        &:disabled:hover,
        &.disabled:hover {
            cursor: default;
        }
    }

    .vue-rating-input {
        position: absolute;
        overflow: hidden;
        margin: 0;
        padding: 0;
        height: 0;
        width: 0;
        border: none;
        opacity: 0;
    }
</style>
