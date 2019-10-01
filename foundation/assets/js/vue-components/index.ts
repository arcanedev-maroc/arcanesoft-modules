import Vue from 'vue'

Vue.config.ignoredElements = [
    'trix-editor',
]

const files = require['context']('./', true, /\.vue$/i)

files.keys().map((key: string) => {
    let file = files(key).default

    if (file.register && file.register === true)
        Vue.component(file.name || key.split('/').pop().split('.')[0], file)
})
