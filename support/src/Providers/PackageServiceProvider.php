<?php

namespace Arcanesoft\Support\Providers;

use Arcanesoft\Support\Providers\Concerns\{
    HasAssets,
    HasConfig,
    HasFactories,
    HasMigrations,
    HasTranslations,
    HasViews
};
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Str;
use ReflectionClass;

/**
 * Class     PackageServiceProvider
 *
 * @package  Arcanesoft\Support\Providers
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class PackageServiceProvider extends ServiceProvider
{
    /* -----------------------------------------------------------------
     |  Traits
     | -----------------------------------------------------------------
     */

    use HasAssets,
        HasConfig,
        HasFactories,
        HasMigrations,
        HasTranslations,
        HasViews;

    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The vendor name.
     *
     * @var  string
     */
    protected $vendor = 'arcanesoft';

    /**
     * The package name.
     *
     * @var  string|null
     */
    protected $package;

    /**
     * The package base path.
     *
     * @var  string
     */
    private $basePath;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->setBasePath(
            dirname((new ReflectionClass($this))->getFileName(), 2)
        );
    }

    /* -----------------------------------------------------------------
     |  Getters & Setters
     | -----------------------------------------------------------------
     */

    /**
     * Get the package name.
     *
     * @return string
     */
    public function packageName(): string
    {
        if (empty($this->package))
            throw new Exception('The package name is required');

        return Str::slug($this->package);
    }

    /**
     * Get the base path of the package.
     *
     * @param  string  $path
     *
     * @return string
     */
    protected function getBasePath(string $path = ''): string
    {
        return $this->basePath.($path ? DIRECTORY_SEPARATOR.$path : $path);
    }

    /**
     * Set the base path.
     *
     * @param  string  $basePath
     *
     * @return $this
     */
    protected function setBasePath(string $basePath)
    {
        $this->basePath = $basePath;

        return $this;
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the publish tag.
     *
     * @param  string  $tag
     *
     * @return string
     */
    protected function getPublishTag(string $tag): string
    {
        return Str::slug("{$this->vendor}-{$tag}");
    }
}
