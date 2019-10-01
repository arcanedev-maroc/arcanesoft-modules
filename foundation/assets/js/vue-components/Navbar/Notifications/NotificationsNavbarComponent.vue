<template>
    <div>
        <a class="nav-link dropdown-toggle no-caret" id="notifications-dropdown" href="#" data-toggle="dropdown">
            <span class="status-indicator">
                <i class="far fa-fw fa-bell"></i>
                <span class="status status-top status-danger" v-show="hasUnread"></span>
            </span>
        </a>
        <div class="navbar-dropdown dropdown-menu dropdown-menu-right" aria-labelledby="notifications-dropdown">
            <h6 class="px-3 py-2 mb-0 font-weight-bold text-center">Notifications</h6>
            <div class="dropdown-divider"></div>

            <div v-for="notification in unreadNotifications" :key="notification.id">
                <a class="dropdown-item">
                    <div class="d-flex align-items-start flex-column justify-content-center">
                        <h6 class="font-weight-normal mb-1">{{ notification.title }}</h6>
                        <p class="text-gray small ellipsis mb-0">{{ notification.message }}</p>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
            </div>

            <a href="#" class="dropdown-item">
                <small class="font-weight-bold">See all notifications</small>
            </a>
        </div>
    </div>
</template>

<script lang="ts">
    import {mapState} from "vuex"

    export default {
        name: "notifications-navbar-component",

        register: true,

        created() {
            this.$store.dispatch("notifications/getAllNotifications")
        },

        computed: {
            ...mapState({
                notifications: state => state["notifications"].all
            }),

            unreadNotifications() {
                return this.notifications.filter((notifications) => {
                    return notifications.read === false;
                });
            },

            hasUnread() {
                return this.unreadNotifications.length > 0;
            },
        },
    }
</script>
