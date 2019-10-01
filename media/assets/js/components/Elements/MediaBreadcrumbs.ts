import Vue from "vue"
import {getters, actions} from "../../store"

export default Vue.extend({
    name: "media-manager-breadcrumbs",

    methods: {
        changeMediaLocation(location): void {
            actions.changeMediaLocation(location)
        },

        isLastLinkIndex(index): boolean {
            return (this.locationLinks.length - 1) === index;
        },
    },

    computed: {
        currentLocation(): string {
            return getters.getCurrentLocation()
        },

        locationLinks(): Array<Object> {
            let locations = [{
                path: '/',
                name: 'Home',
                isRoot: true,
            }]

            if (this.currentLocation !== '/') {
                let lastLocation = ''

                this.currentLocation.split('/').forEach((location) => {
                    locations.push({
                        path: `${lastLocation}/${location}`.replace(/^\/|\/$/g, ''),
                        name: location,
                        isRoot: false,
                    })

                    lastLocation = location
                })
            }

            return locations
        },
    },

    template: `
        <nav class="media-manager-breadcrumb" aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 border-0">
                <li v-for="(link, index) in locationLinks"
                    class="breadcrumb-item" :class="{'active': isLastLinkIndex(index)}">
                    <span v-if="isLastLinkIndex(index)">
                        <i class="fas fa-fw fa-home" v-if="link.isRoot"></i>
                        <span v-else>{{ link.name}}</span>
                    </span>
                    <a v-else href="#" @click.prevent="changeMediaLocation(link.path)">
                        <i class="fas fa-fw fa-home" v-if="link.isRoot"></i>
                        <span v-else>{{ link.name}}</span>
                    </a>
                </li>
            </ol>
        </nav>    
    `
})
