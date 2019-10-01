<template>
    <a class="dropdown-item" href="#" @click.prevent="logout">
        <i class="fas fa-fw fa-power-off mr-2"></i> {{ text }}
    </a>
</template>

<script lang="ts">
    export default {
        name: "logout-nav-btn-component",

        register: true,

        props: ['url', 'text'],

        methods: {
            logout() {
                window['request']().post(this.url)
                    .then((resp) => {
                        location.replace(resp.data.redirect);
                    })
                    .catch(() => {
                        location.reload();
                    });
            },
        },
    }
</script>

<style lang="scss" scoped>
    .nav-link-logout {
        cursor: pointer;

        i {
            color: #dc3545;
        }
    }
</style>
