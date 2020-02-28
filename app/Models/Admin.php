<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Admin extends Authenticatable
{		
	 	use Notifiable;
	 	protected $guard = 'admin';
		protected $fillable = [
        'email', 'name', 'password',
    ];

    protected $hidden = [
        'password',
    ];
    public $timestamps = true;
    protected $table = 'admin';
}
