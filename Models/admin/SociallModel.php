<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SociallModel extends Model
{
    use HasFactory;

    protected $table = 'sociall_links';
    // protected $primaryKey = 'type_id';
    public $timestamps = false;
    protected $guarded = [];  
}
