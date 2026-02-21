<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ImageItem;

class ImageCategory extends Model
{
    protected $table = 'image_categories';
    protected $primaryKey = 'ic_id';
    public $timestamps = false;

    protected $fillable = [
        'ic_name',
        'description',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(ImageItem::class, 'ic_id', 'ic_id');
    }

}

