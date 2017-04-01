<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => '超级管理员',
            'level' => 1,
        ]);

        $userRole = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'description' => '普通用户',
        ]);
        
        /*管理员初始化所有权限*/
        $all_permissions = Permission::all();
        
        foreach($all_permissions as $all_permission){
            $adminRole->attachPermission($all_permission);
        }

        /**
         * 普通用户赋予个人设置权限
         */
        $adminPermission = Permission::where('slug', '=', 'admin')->first();
        $adminPerson = Permission::where('slug', '=', 'admin.person')->first();
        $userRole->attachPermission($adminPermission);
        $userRole->attachPermission($adminPerson);
    }
}
