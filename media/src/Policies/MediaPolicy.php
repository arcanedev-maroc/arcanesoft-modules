<?php

namespace Arcanesoft\Media\Policies;

use App\Models\User as AuthenticatedUser;

/**
 * Class     MediaPolicy
 *
 * @package  Arcanesoft\Media\Policies
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MediaPolicy extends AbstractPolicy
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * Ability's prefix.
     *
     * @var string|null
     */
    protected $prefix = 'admin::media.';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the policy's abilities.
     *
     * @return \Arcanesoft\Support\Policies\Ability[]|array
     */
    public function abilities(): array
    {
        return [

            // admin::media.index
            $this->makeAbility('index')->setMetas([
                'name'        => 'Access the main media manager',
                'description' => 'Ability to access the main media manager',
            ]),

        ];
    }

    /* -----------------------------------------------------------------
     |  Policies
     | -----------------------------------------------------------------
     */

    /**
     * Allow to access the main media manager.
     *
     * @param  \App\Models\User  $user
     *
     * @return bool|void
     */
    public function index(AuthenticatedUser $user)
    {
        //
    }
}
