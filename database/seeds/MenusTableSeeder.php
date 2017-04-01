<?php

use Illuminate\Database\Seeder;
use App\Models\Menu;
class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $index = new Menu;
        $index->name = "总览";
        $index->pid = 0;
        $index->icon = "fa fa-dashboard";
        $index->slug = "home";
        $index->url = "/";
        $index->description = "后台首页";
        $index->save();

        /**
         * -------------------------------------------------
         * 系统管理
         * -------------------------------------------------
         */

        $system = new Menu;
        $system->name = "系统管理";
        $system->pid = 0;
        $system->icon = "fa fa-cog";
        $system->slug = "admin";
        $system->url = "admin";
        $system->description = "系统功能管理";
        $system->save();

        $user = new Menu;
        $user->name = "用户管理";
        $user->pid = $system->id;
        $user->icon = "fa fa-users";
        $user->slug = "admin.user";
        $user->url = "admin/user";
        $user->description = "显示用户管理";
        $user->save();


        $role = new Menu;
        $role->name = "角色管理";
        $role->pid = $system->id;
        $role->icon = "fa fa-male";
        $role->slug = "admin.role";
        $role->url = "admin/role";
        $role->description = "显示角色管理";
        $role->save();


        $permission = new Menu;
        $permission->name = "权限管理";
        $permission->pid = $system->id;
        $permission->icon = "fa fa-paper-plane";
        $permission->slug = "admin.permission";
        $permission->url = "admin/permission";
        $permission->description = "显示权限管理";
        $permission->save();

        $menu = new Menu;
        $menu->name = "菜单管理";
        $menu->pid = $system->id;
        $menu->icon = "fa fa-navicon";
        $menu->slug = "admin.menu";
        $menu->url = "admin/menu";
        $menu->description = "显示菜单管理";
        $menu->save();

        $log = new Menu;
        $log->name = "操作日志";
        $log->pid = $system->id;
        $log->icon = "fa fa-file-text-o";
        $log->slug = "admin.log";
        $log->url = "admin/log";
        $log->description = "显示系统操作日志";
        $log->save();

        $person = new Menu;
        $person->name = "个人设置";
        $person->pid = $system->id;
        $person->icon = "fa fa-circle-o";
        $person->slug = "admin.person";
        $person->url = "admin/person";
        $person->description = "显示个人设置";
        $person->save();
    }
}
