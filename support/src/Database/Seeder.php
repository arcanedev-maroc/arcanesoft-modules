<?php

namespace Arcanesoft\Support\Database;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Seeder as IlluminateSeeder;

/**
 * Class     Seeder
 *
 * @package  Arcanesoft\Support\Database
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
abstract class Seeder extends IlluminateSeeder
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The seeders list.
     *
     * @var array
     */
    protected $seeders = [];

    /* -----------------------------------------------------------------
     |  Getters
     | -----------------------------------------------------------------
     */

    /**
     * Get the seeders.
     *
     * @return array
     */
    public function seeders(): array
    {
        return $this->seeders;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Eloquent::unguard();

        foreach ($this->seeders() as $seed) {
            $this->call($seed);
        }

        Eloquent::reguard();
    }
}