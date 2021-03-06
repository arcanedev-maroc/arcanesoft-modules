<?php

declare(strict_types=1);

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateRoleUserTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see  \Arcanesoft\Foundation\Auth\Models\Pivots\RoleUser
 */
class CreateAuthRoleUserPivotTable extends Migration
{
    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateAuthRoleUserPivotTable constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->setTable(Auth::table('role-user', 'role_user', false));
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $this->createSchema(function (Blueprint $table) {
            $table->unsignedInteger('role_id');
            $table->unsignedBigInteger('user_id');

            $table->timestamp('created_at')->nullable();

            $table->primary(['user_id', 'role_id']);
        });
    }
}
