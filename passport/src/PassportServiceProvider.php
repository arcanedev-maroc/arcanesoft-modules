<?php

declare(strict_types=1);

namespace Arcanesoft\Passport;

use Arcanesoft\Foundation\Support\Providers\PackageServiceProvider;

/**
 * Class     PassportServiceProvider
 *
 * @package  Arcanesoft\Passport
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PassportServiceProvider extends PackageServiceProvider
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The package name.
     *
     * @var string
     */
    protected $package = 'passport';

    /**
     * Merge multiple config files into one instance (package name as root key).
     *
     * @var bool
     */
    protected $multiConfigs = true;
}
