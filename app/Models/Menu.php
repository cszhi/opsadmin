<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model {
	//
	protected $guarded  = ['id'];
	public function submenus() {
		return $this->hasMany('App\Models\Menu', 'pid', 'id')->orderBy('sort');
	}
}
