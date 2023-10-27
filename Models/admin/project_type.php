<?php
namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\tbl_projects;

class project_type extends Model
{
    use HasFactory;

    protected $table = 'project_type';
    public $timestamps = false;
    protected $guarded = [];  

}
