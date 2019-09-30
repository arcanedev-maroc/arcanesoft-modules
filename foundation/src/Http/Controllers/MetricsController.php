<?php namespace Arcanesoft\Foundation\Http\Controllers;

use Arcanedev\LaravelMetrics\Contracts\Manager;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class     MetricsController
 *
 * @package  Arcanesoft\Foundation\Http\Controllers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricsController
{
    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function process(Request $request, Manager $manager)
    {
        $class = $request->get('metric');

        abort_unless($manager->has($class), Response::HTTP_NOT_FOUND, __('Metric not found'));

        $metric = $manager->get($class);

        if ($metric->authorizedToSee($request))
            return response()->json($metric->resolve($request)->toArray());

        return response()->json([
            'message' => 'Access Not Allowed',
            'metric'  => $class,
        ], Response::HTTP_FORBIDDEN);
    }
}
