<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;

class PersonController extends Controller {
	public $module = 'admin.person';
	public $parent_module = 'admin';

	public function __construct() {
		parent::__construct();
		\View::share('title', trans('strings.title.admin.person.main'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$user = User::findOrFail(\Auth::user()->id);
		return view('admin.person.index', compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(requests\PersonUpdateFormRequest $request) {
		$user = User::findOrFail(\Auth::user()->id);
		$user->password = bcrypt($request->password);
		$user->email = $request->email;
		$user->save();
		return back()->with('status', trans('alerts.person.updated_success'));
	}

}
