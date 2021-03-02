<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
	protected $table = 'worker';

    protected $fillable = [
        'id', 'name', 'first_name', 'compny_id', 'email', 'phone'
    ];
}
