<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = ['title', 'description', 'content', 'slug', 'created_at', 'avatar', 'status'];

    const PUBLISHED = 1;
    const PENDING = 0;
}
