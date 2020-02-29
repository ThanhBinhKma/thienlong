<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  protected $table = 'medias';

    protected $fillable = ['title', 'date', 'status', 'avatar', 'status','created_at'];

    const PUBLISHED = 1;
    const PENDING = 0;
}
