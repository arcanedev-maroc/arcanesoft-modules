<?php namespace Arcanesoft\Auth\Metrics\Roles;

use Arcanedev\LaravelMetrics\Metrics\Value;
use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Models\Role;
use Illuminate\Http\Request;

/**
 * Class     TotalRoles
 *
 * @package  Arcanesoft\Auth\Metrics\Roles
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class TotalRoles extends Value
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Auth\Repositories\RolesRepository */
    protected $repo;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * TotalUsersByRoles constructor.
     *
     * @param  \Arcanesoft\Auth\Metrics\Roles\RolesRepository  $repo
     */
    public function __construct(RolesRepository $repo)
    {
        $this->repo = $repo;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Calculate the metric.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Arcanedev\LaravelMetrics\Results\Result|mixed
     */
    public function calculate(Request $request)
    {
        return $this->count($this->repo->query());
    }
}
