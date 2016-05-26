<?php
use Alcodo\Crud\Utilities\PermissionCreator;
use Alcodo\User\Models\Role;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsForMenu extends Migration
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

        // menu
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('Menu', $type);
            $adminRole->attachPermission($permission);
        }

        // menu items
        foreach ($this->getPermissionsTypes() as $type) {
            $permission = $this->createPermission('Menu item', $type);
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
