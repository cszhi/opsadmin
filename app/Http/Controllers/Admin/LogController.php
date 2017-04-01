<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Operation_log;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class LogController extends Controller {
	private $dataTable;
	public $module = 'admin.log';
	public $parent_module = 'admin';

	public function __construct() {
		parent::__construct();
		\View::share('title', trans('strings.title.admin.log.main'));
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		return view('admin.log.index')->with('sub_title', trans('strings.title.admin.log.list'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function ajaxIndex(Request $request, Datatables $dataTable) {
		$this->dataTable = $dataTable;
		$logs = Operation_log::with('user')->select('operation_log.*')
			->leftJoin('users', 'operation_log.user_id', '=', 'users.id')
			->orderBy('id', 'desc');
		return $this->dataTable->eloquent($logs)
			->filter(function ($query) use ($request) {
				if ($request->has('ip')) {
					$query->where('ip', 'like', "%{$request->get('ip')}%");
				}
				if ($request->has('input')) {
					$query->where('input', 'like', "%{$request->get('input')}%");
				}
				if ($request->has('method')) {
					$query->where('method', '=', "{$request->get('method')}");
				}
				if ($request->has('path')) {
					$query->where('path', 'like', "%{$request->get('path')}%");
				}
				if ($request->has('user')) {
					$query->where('users.name', 'like', "%{$request->get('user')}%");
				}
				if ($request->has('starttime')) {
					$query->where('operation_log.created_at', '>=', getTime($request->get('starttime')));
				}
				if ($request->has('endtime')) {
					$query->where('operation_log.created_at', '<=', getTime($request->get('endtime'), false));
				}
			})
			->make(true);
	}

}
