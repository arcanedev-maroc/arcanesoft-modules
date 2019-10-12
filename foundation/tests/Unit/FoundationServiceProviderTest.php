<?php

namespace Arcanesoft\Foundation\Tests\Unit;

use Arcanesoft\Foundation\Tests\TestCase;

/**
 * Class     FoundationServiceProviderTest
 *
 * @package  Arcanesoft\Foundation\Tests\Unit
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class FoundationServiceProviderTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\FoundationServiceProvider */
    private $provider;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp(): void
    {
        parent::setUp();

        $this->provider = $this->app->getProvider(\Arcanesoft\Foundation\FoundationServiceProvider::class);
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Illuminate\Support\ServiceProvider::class,
            \Arcanedev\Support\Providers\ServiceProvider::class,
            \Arcanesoft\Foundation\Support\Providers\ServiceProvider::class,
            \Arcanesoft\Foundation\Support\Providers\PackageServiceProvider::class,
            \Arcanesoft\Foundation\FoundationServiceProvider::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->provider);
        }
    }
}