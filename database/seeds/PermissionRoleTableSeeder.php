<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
        $add = Permission::where('key', 'add_contacts')->first();
        $delete = Permission::where('key', 'delete_contacts')->first();
        DB::table('permission_role')->where('permission_id', $add->id)->delete();
        DB::table('permission_role')->where('permission_id', $delete->id)->delete();
    }
}
