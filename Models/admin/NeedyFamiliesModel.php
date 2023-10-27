<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NeedyFamiliesModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_needy_families';
    protected $primaryKey = 'needy_id';
    public $timestamps = false;
    protected $guarded = []; 
}
