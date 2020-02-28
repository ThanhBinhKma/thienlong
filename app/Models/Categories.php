<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public $timestamps = true;
    protected $table = 'category';
    const PUBLISHED = 1;
    const PENDING = 0;
}
