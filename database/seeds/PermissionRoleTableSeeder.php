<?php

use App\Permission;
use App\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' 
            && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 8) != 'aboutus_'
            && substr($permission->title, 0, 14) != 'announcements_'   && substr($permission->title, 0, 9) != 'contacts_'
            && substr($permission->title, 0, 8) != 'purpose_' && substr($permission->title, 0, 8) != 'setting_'
            && substr($permission->title, 0, 8) != 'holiday_' && substr($permission->title, 0, 9) != 'fulldate_'
            && substr($permission->title, 0, 9) != 'feedback_';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
    }
}
