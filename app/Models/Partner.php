<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    protected $table = 'partners';
    protected $fillable = ['avatar','link', 'status', 'created_at'];

    const PUBLISHED = 1;
    const PENDING = 0;
}
