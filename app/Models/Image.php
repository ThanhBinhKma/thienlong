<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = ['link', 'event_id', 'status','created_at'];

    const PUBLISHED = 1;
    const PENDING = 0;
}
