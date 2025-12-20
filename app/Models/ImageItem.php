<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageItem extends Model
{
    protected $table = 'image_items';
    protected $primaryKey = 'ii_id';
    public $timestamps = false;

    protected $fillable = [
        'ig_id',
        'image_path',
        'image_title',
        'image_desc',
        'status',
    ];
}
