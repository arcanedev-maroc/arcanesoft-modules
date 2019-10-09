<?php 

declare(strict_types=1);

namespace Arcanesoft\Blog\Providers;

use Arcanesoft\Foundation\Core\Providers\MetricServiceProvider as ServiceProvider;

/**
 * Class     MetricServiceProvider
 *
 * @package  Arcanesoft\Blog\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the metrics.
     *
     * @return iterable
     */
    public function metrics(): iterable
    {
        return [];
    }
}
