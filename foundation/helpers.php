<?php

use Arcanesoft\Foundation\Foundation;

if ( ! function_exists('foundation')) {
    /**
     * Get the foundation's class instance.
     *
     * @return \Arcanesoft\Foundation\Foundation
     */
    function foundation() {
        return app(Foundation::class);
    }
}

if ( ! function_exists('auth_user')) {
    /**
     * Get the authenticated user.
     *
     * @return \App\Models\User|\Illuminate\Contracts\Auth\Authenticatable|null
     */
    function auth_user() {
        return auth()->user();
    }
}
