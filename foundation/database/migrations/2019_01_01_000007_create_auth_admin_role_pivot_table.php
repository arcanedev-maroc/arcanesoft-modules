<?php

declare(strict_types=1);

use Arcanesoft\Foundation\Auth\Auth;
use Arcanesoft\Foundation\Auth\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class     CreateAuthAdminRolePivotTable
 *
 * @author   ARCANEDEV <arcanedev.maroc@gmail.com>
 *
 * @see  \Arcanesoft\Foundation\Auth\Models\Pivots\AdminRole
 */
class CreateAuthAdminRolePivotTable extends Migration
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

        $this->setTable(Auth::table('admin-role', 'admin_role', false));
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
            $table->unsignedBigInteger('admin_id');
            $table->unsignedInteger('role_id');
            $table->timestamp('created_at')->nullable();

            $table->primary(['admin_id', 'role_id']);
        });
    }
}
