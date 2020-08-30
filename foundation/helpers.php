<?php

namespace arcanesoft;

use Arcanesoft\Foundation\Foundation;

if ( ! function_exists('arcanesoft\foundation')) {
    /**
     * Get the foundation's class instance.
     *
     * @return \Arcanesoft\Foundation\Foundation
     */
    function foundation() {
        return app(Foundation::class);
    }
}

require_once __DIR__.'/helpers/ui.php';
