<?php

declare(strict_types=1);

namespace Arcanesoft\Foundation\Auth\Console;

use Arcanesoft\Foundation\Auth\Models\Role;
use Arcanesoft\Foundation\Auth\Repositories\AdminsRepository;
use Closure;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Date;

/**
 * Class     MakeAdmin
 *
 * @package  Arcanesoft\Foundation\Auth\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MakeAdmin extends Command
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new admin';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle the command.
     */
    public function handle(): void
    {
        $this->line('');
        $this->comment('Creating a new Admin');

        call_user_func(static::defaultCreateUserCallback(), ...[
            $this->ask('First Name'),
            $this->ask('Last Name'),
            $this->ask('Email Address'),
            $this->secret('Password')
        ]);

        $this->comment('Admin created successfully.');
    }

    /* -----------------------------------------------------------------
     |  Other Methods
     | -----------------------------------------------------------------
     */

    /**
     * Get the default callback used for creating new Nova users.
     *
     * @return \Closure
     */
    protected static function defaultCreateUserCallback(): Closure
    {
        return function (string $firstName, string $lastName, string $email, string $password) {
            /** @var  \Arcanesoft\Foundation\Auth\Repositories\AdminsRepository  $repo */
            $repo  = app(AdminsRepository::class);

            $admin = $repo->forceCreate([
                'first_name'   => $firstName,
                'last_name'    => $lastName,
                'email'        => $email,
                'password'     => $password,
                'activated_at' => Date::now()
            ]);

            $repo->syncRolesByKeys($admin, [Role::ADMINISTRATOR]);
        };
    }
}
