<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submedia extends Model
{
  protected $table = 'submedias';

  public function media()
  {
  	return $this->belongsTo('App\Models\Media','media_id');
  }
}
