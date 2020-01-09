import Foundation from './Foundation'

import './plugins'
import './helpers'
import './modules'
import './vue-components'

/**
 * Init the APP
 */

import store from './store'

window["Foundation"] = new Foundation({
    el: '#foundation',
    store,
})
