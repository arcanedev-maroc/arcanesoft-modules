<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Core\Policies;

use Arcanesoft\Foundation\Auth\Models\Admin;

/**
 * Class     DashboardPolicy
 *
 * @package  Arcanesoft\Foundation\Core\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class DashboardPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the ability's prefix.
     *
     * @return string
     */
    protected static function prefix(): string
    {
        return 'admin::dashboard.';
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanedev\LaravelPolicies\Ability[]|iterable
     */
    public function abilities(): iterable
    {
        $this->setMetas([
            'category' => 'Dashboard',
        ]);

        return [

            // admin::dashboard.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Access the main dashboard',
                'description' => 'Ability to access the main dashboard',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access all the system information.
     *
     * @param  \Arcanesoft\Foundation\Auth\Models\Admin|mixed  $admin
     *
     * @return \Illuminate\Auth\Access\Response|bool|void
     */
    public function index(Admin $admin)
    {
        //
    }
}
