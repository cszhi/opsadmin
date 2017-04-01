<?php


get('login', 'Auth\AuthController@getLogin')->name('login');
post('login', 'Auth\AuthController@postLogin')->name('login.post');
get('users/logout', 'Auth\AuthController@getLogout')->name('logout');

Route::group(['middleware' => 'auth'], function () {
	get('/', 'HomeController@index')->name('home');

	Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function(){
		get('password', 'PasswordController@password')->name('admin.password');
		post('password', 'PasswordController@passwordupdate')->name('admin.password.update');

		//user
		get('user', 'UsersController@index')->name('admin.user')->middleware('permission:admin.user');
		get('user/ajaxIndex', 'UsersController@ajaxIndex')->name('admin.user.ajaxIndex')->middleware('permission:admin.user');
		get('user/create', 'UsersController@create')->name('admin.user.create')->middleware('permission:admin.user.create');
		post('user/create', 'UsersController@store')->name('admin.user.store')->middleware('permission:admin.user.create');
		get('user/{id}/edit', 'UsersController@edit')->name('admin.user.edit')->middleware('permission:admin.user.edit');
		post('user/{id}/edit', 'UsersController@update')->name('admin.user.update')->middleware('permission:admin.user.edit');
		post('user/{id}/delete', 'UsersController@destroy')->name('admin.user.destroy')->middleware('permission:admin.user.destroy');

		//Permission
		get('permission', 'PermissionController@index')->name('admin.permission')->middleware('permission:admin.permission');
		get('permission/ajaxIndex', 'PermissionController@ajaxIndex')->name('admin.permission.ajaxIndex')->middleware('permission:admin.permission');
		get('permission/create', 'PermissionController@create')->name('admin.permission.create')->middleware('permission:admin.permission.create');
		post('permission/create', 'PermissionController@store')->name('admin.permission.store')->middleware('permission:admin.permission.create');
		get('permission/{id}/edit', 'PermissionController@edit')->name('admin.permission.edit')->middleware('permission:admin.permission.edit');
		post('permission/{id}/edit', 'PermissionController@update')->name('admin.permission.update')->middleware('permission:admin.permission.edit');
		post('permission/{id}/delete', 'PermissionController@destroy')->name('admin.permission.destroy')->middleware('permission:admin.permission.destroy');
		// get('permission/attach/{permission}/{roleid}', 'PermissionController@attachPermissionToRole')->name('admin.permission.attach');

		//Role
		get('role', 'RoleController@index')->name('admin.role')->middleware('permission:admin.role');
		get('role/ajaxIndex', 'RoleController@ajaxIndex')->name('admin.role.ajaxIndex')->middleware('permission:admin.role');
		get('role/create', 'RoleController@create')->name('admin.role.create')->middleware('permission:admin.role.create');
		post('role/create', 'RoleController@store')->name('admin.role.store')->middleware('permission:admin.role.create');
		get('role/{id}/edit', 'RoleController@edit')->name('admin.role.edit')->middleware('permission:admin.role.edit');
		post('role/{id}/edit', 'RoleController@update')->name('admin.role.update')->middleware('permission:admin.role.edit');
		post('role/{id}/delete', 'RoleController@destroy')->name('admin.role.destroy')->middleware('permission:admin.role.destroy');
		// get('role/attach/{role}/{userid}', 'RoleController@attachUserToRole')->name('admin.role.attach')->middleware('permission:');

		//Menu
		get('menu', 'MenuController@index')->name('admin.menu')->middleware('permission:admin.menu');
		post('menu/create', 'MenuController@store')->name('admin.menu.store')->middleware('permission:admin.menu.create');
		get('menu/{id}/edit', 'MenuController@edit')->name('admin.menu.edit')->middleware('permission:admin.menu.edit');
		post('menu/{id}/edit', 'MenuController@update')->name('admin.menu.update')->middleware('permission:admin.menu.edit');
		post('menu/{id}/delete', 'MenuController@destroy')->name('admin.menu.destroy')->middleware('permission:admin.menu.destroy');

		//Log
		get('log', 'LogController@index')->name('admin.log')->middleware('permission:admin.log');
		get('log/ajaxIndex', 'LogController@ajaxIndex')->name('admin.log.ajaxIndex')->middleware('permission:admin.log');

		//person
		get('person', 'PersonController@index')->name('admin.person')->middleware('permission:admin.person');
		post('person', 'PersonController@update')->name('admin.person.update')->middleware('permission:admin.person');
	});
});





