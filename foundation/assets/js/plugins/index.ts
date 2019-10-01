// Lodash
//-----------------------

import * as _ from "lodash"
window["_"] = _

// Twitter Bootstrap
//-----------------------

try {
    window["Popper"] = require("popper.js").default
    window["$"] = window["jQuery"] = require("jquery")

    require("bootstrap")
} catch (e) {}

// Moment
//-----------------------

import moment from "moment-timezone"
window["moment"] = moment

// DateTime picker
//-----------------------

import flatpickr from "flatpickr"
import fpLanguages from "../lang/plugins/flatpickr"

// Tables
//-----------------------

import "datatables.net-dt"
import dtLanguages from "../lang/plugins/datatables"

// Select 2
//-----------------------

import "select2"

// ChartJS
//-----------------------

import Chart from "chart.js"

// TuiEditor
//-----------------------

window["TuiEditor"] = require("tui-editor")

// Plugins Container
//----------------------------------------

window["plugins"] = {
    datatable: (selector, options: Object = {}) => {
        options = _.merge({
            pageLength: 25,
            lengthMenu: [10, 25, 50, 75, 100],
            responsive: true,
            searchDelay: 1000, // 1 second
            language: dtLanguages[window["Foundation"].getLocale()]
        }, options)

        return window["$"](selector).DataTable(options)
    },

    chartJs: (ctx, options?: Object) => {
        if (typeof ctx === "string")
            ctx = <HTMLCanvasElement> document.getElementById(ctx)

        options = _.merge({
            options: {
                maintainAspectRatio: false
            }
        }, options)

        return new Chart(ctx.getContext('2d'), options)
    },

    flatpickr: (selector, options?: Object) => {
        options = _.merge(options, {
            locale: fpLanguages[options['locale'] || window["Foundation"].getLocale()]
        })

        return flatpickr(selector, options)
    },

    select2: (selector, options?: Object) => {
        options = _.merge({
            width: '100%',
            theme: 'bootstrap-4',
        }, options)

        return window["$"](selector).select2(options)
    }
}
