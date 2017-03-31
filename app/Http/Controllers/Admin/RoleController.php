<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use Yajra\Datatables\Facades\Datatables;

class RoleController extends Controller
{
    //http://ops2.app/admin/role/attach/superuser/1
    public function attachUserToRole($role, $userid)
    {
        $user = User::find($userid);
        $role = Role::whereSlug($role)->first();

        $user->attachRole($role);
    }

    public $module = 'admin.role';
    public $parent_module = 'admin';
    private $dataTable;

    public function __construct() {
        parent::__construct();
        \View::share('title', '角色管理');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.role.index')->with('sub_title', '角色列表');
    }

    public function ajaxIndex() {
        $roles = Role::select(['id', 'name', 'slug', 'description', 'updated_at']);
        return Datatables::of($roles)
            ->addColumn('action', function ($role) {
                return '<a href="' . route('admin.role.edit', $role->id) . '" class="fa fa-fw fa-edit"></a>&nbsp;&nbsp;<a class="fa fa-trash" href="#" data-toggle="modal" data-target="#DeleteModal" data-name="' . $role->name . '" data-action="' . route('admin.role.destroy', $role->id) . '"></a>';
            })
            ->make(true);
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('admin.role.create', compact('permissions'))->with('sub_title', '创建角色');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(requests\RoleCreateFormRequest $request) {
        $role = Role::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);
        $role->permissions()->sync($request->permission);
        return redirect()->route('admin.role')->with([
            'status' => '创建角色成功：' . $role->name,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::with('permissions')->findOrFail($id);
        $rolePermissions = $role->permissions->lists('id')->toArray();
        $permissions = Permission::all();
        return view('admin.role.edit', compact('role', 'rolePermissions', 'permissions'))->with('sub_title', '编辑角色');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(requests\RoleEditFormRequest $request, $id)
    {
        $role = Role::findOrFail($id);
        if($role->slug == 'admin') {
            return redirect()->route('admin.role')->with([
                'warn' => '无法编辑角色：' . $role->name,
            ]);
        }
        $role->update($request->all());
        $role->permissions()->sync($request->permission);
        return redirect()->route('admin.role')->with([
            'status' => '编辑角色成功：' . $role->name,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $role = Role::findOrFail($id);
        if($role->slug == 'admin') {
            return redirect()->route('admin.role')->with([
                'warn' => '无法删除角色：' . $role->name,
            ]);
        }
        $role->delete();
        return redirect()->route('admin.role')->with([
            'status' => '删除角色成功：' . $role->name,
        ]);
    }
}
