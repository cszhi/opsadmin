<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class RoleController extends Controller {
	//http://ops2.app/admin/role/attach/superuser/1
	public function attachUserToRole($role, $userid) {
		$user = User::find($userid);
		$role = Role::whereSlug($role)->first();

		$user->attachRole($role);
	}

	public $module = 'admin.role';
	public $parent_module = 'admin';
	private $dataTable;

	public function __construct() {
		parent::__construct();
		\View::share('title', trans('strings.title.admin.role.main'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admin.role.index')->with('sub_title', trans('strings.title.admin.role.list'));
	}

	public function ajaxIndex() {
		$roles = Role::select(['id', 'name', 'slug', 'description', 'updated_at']);
		return Datatables::of($roles)
			->addColumn('action', function ($role) {
				$action = "";
				if(\Auth::user()->can('admin.role.edit')){
					$action = $action . '<a href="' . route('admin.role.edit', $role->id) . '" class="fa fa-fw fa-edit"></a>&nbsp;&nbsp;';
				}
				if(\Auth::user()->can('admin.role.destroy')){
					$action = $action . '<a class="fa fa-trash" href="#" data-toggle="modal" data-target="#DeleteModal" data-name="' . $role->name . '" data-action="' . route('admin.role.destroy', $role->id) . '"></a>';
				}
				return $action;
			})
			->make(true);
	}

	public function create() {
		$permissions = Permission::all();
		return view('admin.role.create', compact('permissions'))->with('sub_title', trans('strings.title.admin.role.create'));
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
			'status' => trans('alerts.roles.created_success') . $role->name,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$role = Role::with('permissions')->findOrFail($id);
		$rolePermissions = $role->permissions->lists('id')->toArray();
		$permissions = Permission::all();
		return view('admin.role.edit', compact('role', 'rolePermissions', 'permissions'))->with('sub_title', trans('strings.title.admin.role.edit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(requests\RoleEditFormRequest $request, $id) {
		$role = Role::findOrFail($id);
		if ($role->slug == 'admin') {
			return redirect()->route('admin.role')->with([
				'warn' => trans('alerts.roles.updated_error') . $role->name,
			]);
		}
		$role->update($request->all());
		$role->permissions()->sync($request->permission);
		return redirect()->route('admin.role')->with([
			'status' => trans('alerts.roles.updated_success') . $role->name,
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
		if ($role->slug == 'admin') {
			return redirect()->route('admin.role')->with([
				'warn' => trans('alerts.roles.deleted_success') . $role->name,
			]);
		}
		$role->delete();
		return redirect()->route('admin.role')->with([
			'status' => trans('alerts.roles.deleted_error') . $role->name,
		]);
	}
}
