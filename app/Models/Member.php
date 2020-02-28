<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
   protected $table = 'members';

   protected $fillable = ['created_at','name','position','avatar','status'];

   public function submedias()
   {
   	return $this->hasMany('App\Models\Submedia','id');
   }
}
