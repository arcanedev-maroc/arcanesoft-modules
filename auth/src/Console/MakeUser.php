<?php

namespace Arcanesoft\Auth\Console;

use Arcanesoft\Auth\Auth;
use Arcanesoft\Auth\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

/**
 * Class     MakeUser
 *
 * @package  Arcanesoft\Auth\Console
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 */
class MakeUser extends Command
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
    protected $signature = 'make:user {--admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    public function handle()
    {
        $this->comment('Creating a new User');

        call_user_func(static::defaultCreateUserCallback(), ...[
            $this->ask('First Name'),
            $this->ask('Last Name'),
            $this->ask('Email Address'),
            $this->secret('Password'),
            $this->option('admin')
        ]);

        $this->comment('User created successfully.');
        $this->line('');
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
    protected static function defaultCreateUserCallback()
    {
        return function (string $firstName, string $lastName, string $email, string $password, bool $isAdmin) {
            $now = Carbon::now();

            /** @var  \App\Models\User  $model */
            $model = app(Auth::model('user'))->newQuery()->forceCreate([
                'first_name'        => $firstName,
                'last_name'         => $lastName,
                'email'             => $email,
                'email_verified_at' => $now,
                'password'          => $password,
                'is_admin'          => $isAdmin,
                'activated_at'      => $now
            ]);

            $model->syncRoles($isAdmin ? [Role::ADMINISTRATOR] : [Role::MEMBER]);
        };
    }
}
