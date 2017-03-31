<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Yajra\Datatables\Facades\Datatables;
use Bican\Roles\Models\Role;

class UsersController extends Controller {
	public $module = 'admin.user';
	public $parent_module = 'admin';
	private $dataTable;

	public function __construct() {
		parent::__construct();
		\View::share('title', '用户管理');
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admin.user.index')->with('sub_title', '用户列表');
	}

	public function ajaxIndex() {
		// $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at']);
		$users = User::with('role')->select('users.*');
		return Datatables::of($users)
			->addColumn('action', function ($user) {
				return '<a href="' . route('admin.user.edit', $user->id) . '" class="fa fa-fw fa-edit"></a>&nbsp;&nbsp;<a class="fa fa-trash" href="#" data-toggle="modal" data-target="#DeleteModal" data-name="' . $user->name . '" data-action="' . route('admin.user.destroy', $user->id) . '"></a>';
			})
			->addColumn('role', function($user) {
				return $user->role->lists('name')->first();
			}) 
			->make(true);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$roles = Role::all();
		return view('admin.user.create', compact('roles'))->with('sub_title', '添加用户');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */

	public function store(requests\UsersCreateFormRequest $request) {
		$user = User::create([
			'name' => $request->name,
			'email' => $request->email,
			'password' => bcrypt($request->password),
		]);
		$role[] = $request->get('role'); 
		$user->roles()->sync($role);
		return redirect()->route('admin.user')->with([
			'status' => '创建用户成功：' . $user->name,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$user = User::findOrFail($id);
		$roles = Role::all();
		return view('admin.user.edit', compact('user', 'roles'))->with('sub_title', '编辑用户');
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(requests\UsersEditFormRequest $request, $id) {
		$data['email'] = $request->get('email');
		if ($request->has('password')) {
			$data['password'] = bcrypt($request->get('password'));
		}
		$user = User::findOrFail($id);
		if($user->name == 'admin'){
			return redirect()->route('admin.user')->with([
				'warn' => '无法编辑用户：' . $user->name,
			]);
		}
		$role[] = $request->get('role'); 
		$user->roles()->sync($role);
		$user->update($data);

		return redirect()->route('admin.user')->with([
			'status' => '编辑用户成功：' . $user->name,
		]);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$user = User::findOrFail($id);
		if ($user->name == 'admin') {
			return redirect()->route('admin.user')->with([
				'warn' => '无法删除用户：' . $user->name,
			]);
		};
		$user->delete();
		return redirect()->route('admin.user')->with([
			'status' => '删除用户成功：' . $user->name,
		]);
	}
}
