import Vue from 'vue'
import UI from './UI'

Vue.config.ignoredElements = [
    // Use a `RegExp` to ignore all elements that start with "x-" (2.5+ only)
    /^x-/,
]

export default class Arcanesoft {
    // Properties
    //----------------------------------

    public app: Vue
    public bus: Vue
    public ui: UI
    protected _config: Object
    public launched: Boolean = false

    // Constructor
    //----------------------------------

    public constructor(config: {}) {
        this._config = config
        this.bus = new Vue
        this.ui = new UI
    }

    // Main Methods
    //----------------------------------

    public run(): void {
        if (this.launched === true)
            return

        this.$emit('arcanesoft::starting', {arcanesoft: this})

        let _this = this

        this.app = new Vue({
            el: _this._config['el'],
            store: _this._config['store'],
            components: _this._config['components'] || {},

            mounted: () => {
                _this.initComponents(document)
            }
        })

        this.$emit('arcanesoft::started', {arcanesoft: this})

        this.launched = true
    }

    public getLocale(): string {
        return this._config['locale']
            || document.querySelector('html').getAttribute('lang')
    }

    /**
     * Register a listener on built-in event bus
     */
    public $on(event: string|string[], callback: Function): this {
        this.bus.$on(event, callback)

        return this
    }

    /**
     * Register a one-time listener on the event bus
     */
    public $once(event: string | string[], callback: Function): void {
        this.bus.$once(event, callback)
    }

    /**
     * Unregister an listener on the event bus
     */
    public $off(...args): void {
        this.bus.$off(...args)
    }

    /**
     * Emit an event on the event bus
     */
    public $emit(event: string, ...args: any[]): void {
        this.bus.$emit(event, ...args)
    }

    // Utilities
    //----------------------------------

    /**
     * Return an instance configured to make HTTP requests.
     */
    public request(options?: Object) {
        return window['request'](options)
    }

    // Other Methods
    //----------------------------------

    public initComponents(dom: Document|Element): void {
        this.ui.initToasts(dom)
        this.ui.initTooltips(dom)
        this.ui.initPageScrolled()
        this.ui.initTextAutosize()
    }
}
