<?php

use Illuminate\Database\Seeder;
use Bican\Roles\Models\Permission;
class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Permission::create([
            'name' => 'Home',
            'slug' => 'home',
            'description' => '总览'
        ]);

        Permission::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => '系统管理'
        ]);

        Permission::create([
            'name' => 'Admin menu',
            'slug' => 'admin.menu',
            'description' => '系统菜单管理'
        ]);

        Permission::create([
            'name' => 'Admin menu create',
            'slug' => 'admin.menu.create',
            'description' => '系统创建菜单'
        ]);

        Permission::create([
            'name' => 'Admin menu destroy',
            'slug' => 'admin.menu.destroy',
            'description' => '系统删除菜单'
        ]);

        Permission::create([
            'name' => 'Admin menu edit',
            'slug' => 'admin.menu.edit',
            'description' => '系统编辑菜单'
        ]);

        Permission::create([
            'name' => 'Admin permission',
            'slug' => 'admin.permission',
            'description' => '系统权限管理'
        ]);

        Permission::create([
            'name' => 'Admin permission create',
            'slug' => 'admin.permission.create',
            'description' => '系统创建权限'
        ]);

        Permission::create([
            'name' => 'Admin permission destroy',
            'slug' => 'admin.permission.destroy',
            'description' => '系统删除权限'
        ]);

        Permission::create([
            'name' => 'Admin permission edit',
            'slug' => 'admin.permission.edit',
            'description' => '系统编辑权限'
        ]);

        Permission::create([
            'name' => 'Admin role',
            'slug' => 'admin.role',
            'description' => '系统权限管理'
        ]);

        Permission::create([
            'name' => 'Admin role create',
            'slug' => 'admin.role.create',
            'description' => '系统创建权限'
        ]);

        Permission::create([
            'name' => 'Admin role destroy',
            'slug' => 'admin.role.destroy',
            'description' => '系统删除权限'
        ]);

        Permission::create([
            'name' => 'Admin role edit',
            'slug' => 'admin.role.edit',
            'description' => '系统编辑权限'
        ]);

        Permission::create([
            'name' => 'Admin user',
            'slug' => 'admin.user',
            'description' => '系统用户管理'
        ]);

        Permission::create([
            'name' => 'Admin user create',
            'slug' => 'admin.user.create',
            'description' => '系统创建用户'
        ]);

        Permission::create([
            'name' => 'Admin user destroy',
            'slug' => 'admin.user.destroy',
            'description' => '系统删除用户'
        ]);

        Permission::create([
            'name' => 'Admin user edit',
            'slug' => 'admin.user.edit',
            'description' => '系统编辑用户'
        ]);

        Permission::create([
            'name' => 'Admin log',
            'slug' => 'admin.log',
            'description' => '查看操作日志'
        ]);

        Permission::create([
            'name' => 'Admin person',
            'slug' => 'admin.person',
            'description' => '系统个人设置'
        ]);

        
    }
}
