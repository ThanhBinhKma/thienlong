<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
   protected $table = 'members';

   protected $fillable = ['created_at','name','position','avatar','status'];
   
   const PUBLISHED = 1;
    const PENDING = 0;

   public function submedias()
   {
   	return $this->hasMany('App\Models\Submedia','id');
   }
}
