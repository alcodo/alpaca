<?php

use Alcodo\Crud\Permission\Permission;
use Alcodo\User\Models\Role;
use Alcodo\User\Models\User;
use Illuminate\Support\Facades\DB;

class UserModule
{
    /**
     * Install module
     *
     * @return void
     */
    public function install()
    {
        // Roles
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'Admin';
        $admin->description = 'Administration users';
        $admin->save();

        $user = new Role();
        $user->name = 'user';
        $user->display_name = 'User';
        $user->description = 'Registered users';
        $user->save();

        // Permissions
        $permission_user = new Permission();
        $permission_user->name = 'user-administration';
        $permission_user->display_name = 'User: Administration';
        $permission_user->description = 'CRUD users';
        $permission_user->save();

        $permission_video = new Permission();
        $permission_video->name = 'video-administration';
        $permission_video->display_name = 'Video: Administration';
        $permission_video->description = 'CRUD video';
        $permission_video->save();

        $admin->attachPermissions(array(
            $permission_user,
            $permission_video
        ));

        // User
        $admin_user = User::create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
        ]);

        $admin_user->attachRole($admin);
    }

    /**
     * Remove module
     *
     * @return void
     */
    public function remove()
    {
        DB::table('users')->delete();
        DB::table('pages')->delete();
        DB::table('permissions')->delete();
    }
}
