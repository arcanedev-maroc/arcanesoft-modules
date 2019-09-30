<?php namespace Arcanesoft\Auth\Providers;

use Arcanesoft\Auth\Metrics;
use Arcanesoft\Support\Providers\MetricServiceProvider as ServiceProvider;

/**
 * Class     MetricServiceProvider
 *
 * @package  Arcanesoft\Auth\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MetricServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The metrics.
     *
     * @var array
     */
    protected $metrics = [
        // Users
        Metrics\Users\TotalUsers::class,
        Metrics\Users\NewUsers::class,
        Metrics\Users\ActivatedUsers::class,
        Metrics\Users\VerifiedEmails::class,

        Metrics\Users\UsersPerMinute::class,
        Metrics\Users\UsersPerHour::class,
        Metrics\Users\UsersPerDay::class,
        Metrics\Users\UsersPerWeek::class,
        Metrics\Users\UsersPerMonth::class,

        // Roles
        Metrics\Roles\TotalRoles::class,
        Metrics\Roles\TotalUsersByRoles::class,

        // Password Resets
        Metrics\PasswordResets\TotalPasswordResets::class,
        Metrics\PasswordResets\PasswordResetsPerDay::class,
    ];
}
