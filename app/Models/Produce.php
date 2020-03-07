<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produce extends Model
{
    protected $table = 'produces';
    protected $fillable = ['title', 'slug', 'date', 'link', 'avatar', 'status', 'created_at'];

    const PUBLISHED = 1;
    const PENDING = 0;
}
