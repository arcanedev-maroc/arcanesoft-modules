import translations from "../lang";
import Translator from "@arcanesoft/helpers/js/Utilities/Translator"

const trans = new Translator(translations)

export default {
    methods: {
        getCurrentLocale(): string {
            return trans.getLocale()
        },

        __(key: string, replacers: Object = {}): string {
            return trans.get(key, replacers)
        },
    },
}
