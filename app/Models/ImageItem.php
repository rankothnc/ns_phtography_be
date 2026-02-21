<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImageCategory;

class ImageItem extends Model
{
    protected $table = 'image_items';
    protected $primaryKey = 'ii_id';
    public $timestamps = false;

    protected $fillable = [
        'ic_id',
        'image_path',
        'image_title',
        'capture_date',
        'image_desc_short',
        'image_desc_long',
        'status',
        'c_date',
        'm_date'
    ];

    public function category()
    {
        return $this->belongsTo(ImageCategory::class, 'ic_id', 'ic_id');
    }
}
