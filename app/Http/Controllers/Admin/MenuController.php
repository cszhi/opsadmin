<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Menu;
use Yajra\Datatables\Facades\Datatables;
use Bican\Roles\Models\Permission;

class MenuController extends Controller
{
    public $module = 'admin.menu';
    public $parent_module = 'admin';
    private $dataTable;

    public function __construct() {
        parent::__construct();
        \View::share('title', '菜单管理');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('admin.menu.index', compact('permissions'))->with('sub_title', '菜单列表');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(requests\MenuCreateFormRequest $request)
    {
        $data = $request->except('_token');
        Menu::create($data);
        return redirect()->route('admin.menu')->with([
            'status' => '创建菜单成功：' . $data['name'],
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
        $m = Menu::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.menu.edit', compact('m', 'permissions'))->with('sub_title', '编辑菜单');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(requests\MenuEditFormRequest $request, $id)
    {
        $data = $request->except('_token');
        $menu = Menu::findOrFail($id);
        $menu->update($data);

        return redirect()->route('admin.menu')->with([
            'status' => '修改菜单成功： ' . $data['name'],
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        return redirect()->route('admin.menu')->with([
            'status' => '删除菜单成功： ' . $menu->name,
        ]);
    }
}
