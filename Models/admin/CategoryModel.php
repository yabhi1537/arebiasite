<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\tbl_projects;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';
    public $timestamps = false;
    protected $guarded = [];  

}
