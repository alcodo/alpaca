<?php
use Alcodo\Crud\Utilities\PermissionCreator;
use Alcodo\User\Models\Role;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsForBlock extends Migration
{
    use PermissionCreator;

    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // add permission the admin role
        $adminRole = Role::where('name', 'admin')->first();

        // block
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('Block', $type);
            $adminRole->attachPermission($permission);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
    }
}
