<?php

namespace Arcanedev\LaravelPolicies\Tests;

use Arcanedev\LaravelPolicies\Tests\Fixtures\Policies\PostsPolicy;

/**
 * Class     PolicyTest
 *
 * @package  Arcanedev\LaravelPolicies\Tests
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class PolicyTest extends TestCase
{
    /* -----------------------------------------------------------------
     |  Tests
     | -----------------------------------------------------------------
     */

    /** @test */
    public function it_can_be_instantiated()
    {
        $policy = new PostsPolicy;

        $expectations = [
            \Arcanedev\LaravelPolicies\Contracts\Policy::class,
            \Arcanedev\LaravelPolicies\Policy::class,
        ];

        foreach ($expectations as $expected) {
            static::assertInstanceOf($expected, $policy);
        }
    }

    /** @test */
    public function it_can_get_abilities_as_array()
    {
        $abilities = (new PostsPolicy)->abilities();

        static::assertCount(4, $abilities);

        $expected = [
            'key'    => 'admin::blog.posts.index',
            'method' => 'index',
            'metas'  => [
                'name'        => 'List all the posts',
                'description' => 'Ability to list all the posts',
            ]
        ];

        static::assertEquals($expected, $abilities[0]->toArray());
    }

    /** @test */
    public function it_can_get_abilities_as_collection()
    {
        $abilities = (new PostsPolicy)->abilitiesAsCollection();

        static::assertInstanceOf(\Illuminate\Support\Collection::class, $abilities);
        static::assertCount(4, $abilities);

        $expected = [
            'key'    => 'admin::blog.posts.index',
            'method' => 'index',
            'metas'  => [
                'name'        => 'List all the posts',
                'description' => 'Ability to list all the posts',
            ]
        ];

        /** @var  \Arcanedev\LaravelPolicies\Ability  $ability */
        $ability = $abilities->first();
        static::assertInstanceOf(\Arcanedev\LaravelPolicies\Ability::class, $ability);
        static::assertEquals($expected, $ability->toArray());
    }
}
