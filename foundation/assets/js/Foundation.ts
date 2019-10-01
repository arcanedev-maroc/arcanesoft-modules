import Vue from 'vue'
import UI from "./classes/UI"

class Foundation {
    // Properties
    //----------------------------------

    public app: Vue
    public bus: Vue
    public ui: UI
    protected _config: Object
    public launched: Boolean

    // Constructor
    //----------------------------------

    public constructor(config: {}) {
        this._config = config
        this.bus = new Vue
        this.ui = new UI
        this.launched = false
    }

    // Main Methods
    //----------------------------------

    public run(): void {
        if (this.launched === true)
            return

        let _this = this

        this.app = new Vue({
            el: this._config['el'],

            store: this._config['store'],

            mounted() {
                _this.initComponents()
            }
        })

        this.launched = true
    }

    public getLocale(): string {
        return this._config['locale']
            || document.querySelector('html').getAttribute('lang')
    }

    /**
     * Register a listener on built-in event bus
     */
    public $on(event: string|string[], callback: Function): void {
        this.bus.$on(event, callback)
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

    private initComponents(): void {
        this.ui.initToasts();
        this.ui.initTooltips();
    }
}

export default Foundation;
