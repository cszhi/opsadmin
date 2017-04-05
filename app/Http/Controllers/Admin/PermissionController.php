<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Bican\Roles\Models\Permission;
use Bican\Roles\Models\Role;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;

class PermissionController extends Controller {
	//http://ops2.app/admin/permission/attach/alert.delete/4
	public function attachPermissionToRole($premission, $roleid) {
		$permission = Permission::whereSlug($premission)->first();
		// dd($permission);
		$role = Role::find($roleid);
		// dd($role);
		$role->attachPermission($permission);
	}

	public $module = 'admin.permission';
	public $parent_module = 'admin';
	private $dataTable;

	public function __construct() {
		parent::__construct();
		\View::share('title', trans('strings.title.admin.permission.main'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admin.permission.index')->with('sub_title', trans('strings.title.admin.permission.list'));
	}

	public function ajaxIndex() {
		$permissions = Permission::select(['id', 'name', 'slug', 'description', 'updated_at']);
		return Datatables::of($permissions)
			->addColumn('action', function ($permission) {
				$action = "";
				if(\Auth::user()->can('admin.permission.edit')){
					$action = $action . '<a href="' . route('admin.permission.edit', $permission->id) . '" class="fa fa-fw fa-edit"></a>&nbsp;&nbsp;';
				}
				if(\Auth::user()->can('admin.permission.destroy')){
					$action = $action . '<a class="fa fa-trash" href="#" data-toggle="modal" data-target="#DeleteModal" data-name="' . $permission->name . '" data-action="' . route('admin.permission.destroy', $permission->id) . '"></a>';
				}
				return $action;
			})
			->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('admin.permission.create')->with('sub_title', trans('strings.title.admin.permission.create'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(requests\PermissionCreateFormRequest $request) {
		$permission = Permission::create([
			'name' => $request->name,
			'slug' => $request->slug,
			'description' => $request->description,
		]);
		$role = Role::whereSlug('admin')->first();
		$role->attachPermission($permission);

		return redirect()->route('admin.permission')->with([
			'status' => trans('alerts.permissions.created_success') . $permission->name,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$permission = Permission::findOrFail($id);
		return view('admin.permission.edit', compact('permission'))->with('sub_title', trans('strings.title.admin.permission.edit'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(requests\PermissionEditFormRequest $request, $id) {
		$permission = Permission::findOrFail($id);
		$permission->update($request->all());
		return redirect()->route('admin.permission')->with([
			'status' => trans('alerts.permissions.updated_success') . $permission->name,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$permission = Permission::findOrFail($id);
		$role = Role::whereSlug('admin')->first();
		$role->detachPermission($permission);
		$permission->delete();
		return redirect()->route('admin.permission')->with([
			'status' => trans('alerts.permissions.deleted_success') . $permission->name,
		]);
	}
}
