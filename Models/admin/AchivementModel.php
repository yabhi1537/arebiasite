<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchivementModel extends Model
{
    use HasFactory;
    protected $table = 'achivement';
    public $timestamps = false;
    protected $guarded = [];  
}
