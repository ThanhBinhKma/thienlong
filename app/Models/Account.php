<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'admin';

    const Facebook = 1 ;
    const Twiter = 2;
    const PUBLISHED = 1;
    const PENDING = 0;
}
