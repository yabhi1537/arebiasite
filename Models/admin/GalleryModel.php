<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryModel extends Model
{
    use HasFactory;
    
    protected $table = 'media_gallery';
    public $timestamps = false;
    protected $guarded = []; 
    
}
