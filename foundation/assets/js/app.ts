import Foundation from './Foundation'

import './plugins'

import './helpers'

import './modules'

import './vue-components'

/**
 * Init the APP
 */

import store from './store'

const defaultConfig = {
    el: '#foundation',
    store,
}

;(function() {
    this.CreateFoundation = function(config) {
        return new Foundation(
            window["_"].merge({}, config, defaultConfig)
        )
    }
}.call(window))
