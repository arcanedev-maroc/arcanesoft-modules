import LoadingButton from './UI/LoadingButton';
import toastEvents from '../vue-components/Toasts/events';

export default class {
    toast(toast) {
        window['Foundation'].$emit(toastEvents.UI_TOASTS_NOTIFY, toast)
    }

    initToasts() {
        // window['$']('.toast').toast()
    }

    initTooltips() {
        window['$']('body').tooltip({
            selector: '[data-toggle="tooltip"]',
            boundary: 'window'
        });
    }

    loadingButton(elt) {
        return new LoadingButton(
            typeof elt === 'string'
                ? document.querySelector(elt)
                : elt
        );
    }
}
