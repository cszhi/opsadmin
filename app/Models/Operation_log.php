<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operation_log extends Model
{
	protected $table = 'operation_log';
    protected $fillable = ['user_id', 'path', 'method', 'ip', 'input'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
