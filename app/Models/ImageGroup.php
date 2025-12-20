<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageGroup extends Model
{
    protected $table = 'image_groups';
    protected $primaryKey = 'ig_id';
    public $timestamps = false;

    protected $fillable = [
        'ig_name',
        'status',
    ];
}

