<?php

namespace Arcanesoft\Foundation\Tests\Unit\Auth\Repositories;

use Arcanesoft\Foundation\Tests\Stubs\Models\User as UserModel;
use Arcanesoft\Foundation\Tests\TestCase;

/**
 * Class     UsersRepositoryTest
 *
 * @package  Arcanesoft\Foundation\Tests\Unit\Auth\Repositories
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class UsersRepositoryTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Arcanesoft\Foundation\Auth\Repositories\UsersRepository */
    private $repo;

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrations();
        $this->loadFactories();

        $this->repo = $this->app->make(\Arcanesoft\Foundation\Auth\Repositories\UsersRepository::class);
    }

    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $expectations = [
            \Arcanesoft\Foundation\Support\Repositories\Repository::class,
            \Arcanesoft\Foundation\Auth\Repositories\UsersRepository::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $this->repo);
        }
    }

    /** @test */
    public function it_can_get_model_instance()
    {
        $model = $this->repo->model();

        $expectations = [
            \Illuminate\Foundation\Auth\User::class,
            \Arcanedev\LaravelImpersonator\Contracts\Impersonatable::class,
            \Arcanesoft\Foundation\Auth\Models\User::class,
            \Arcanesoft\Foundation\Tests\Stubs\Models\User::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $model);
        }
    }

    /** @test */
    public function it_can_get_all_users()
    {
        $users = factory(UserModel::class, 2)->create();

        $actual = $this->repo->all();

        static::assertCount($users->count(), $actual);
    }
}
