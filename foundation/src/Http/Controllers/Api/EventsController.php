<?php namespace Arcanesoft\Foundation\Http\Controllers\Api;

use Illuminate\Http\Request;

/**
 * Class     EventsController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers\Api
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class EventsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function handle(Request $request)
    {
        $class = $request->get('class');

        event(
            new $class(
                $request->get('options', [])
            )
        );

        return response()->json();
    }
}
