import Vue from "vue"
import {Translator} from "../../../mixins"

export default Vue.extend({
    name: "v-preview-no-selected-media-item",

    mixins: [Translator],

    template: `
        <div>
            <div class="item-preview-icon d-flex justify-content-center">
                <i class="fa fa-fw fa-5x fa-info-circle"></i>
            </div>
            <p class="p-2">
                <small>{{ __('No selected item !') }}</small>
            </p>
        </div>
    `,
})
