// "Document is Ready" Helper
window['ready'] = (callback) => {
    if (document.readyState !== 'loading')
        callback()
    else if (document.addEventListener)
        document.addEventListener('DOMContentLoaded', callback)
    else
        document['attachEvent']('onreadystatechange', () => {
            if (document.readyState !== 'loading')
                callback()
        })
}

// Request Helper
import request from '@arcanesoft/helpers/js/Utilities/Request'

window['request'] = request;
