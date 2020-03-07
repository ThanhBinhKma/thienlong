<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submedia extends Model
{
    protected $table = 'submedias';

    protected $fillable = ['media_id', 'title','slug', 'link', 'status', 'created_at'];

    const PUBLISHED = 1;
    const PENDING = 0;

    public function media()
    {
        return $this->belongsTo('App\Models\Media', 'media_id');
    }
}
