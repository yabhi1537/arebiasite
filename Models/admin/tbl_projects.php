<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\project_type;
use App\Models\admin\CategoryModel;

class tbl_projects extends Model
{
    use HasFactory;
    
    protected $table = 'tbl_projects';

    public $timestamps = false;
    protected $primaryKey = 'project_id';

    protected $guarded = [];  

    public function ProjTyp()
    {
     return $this->belongsTo('App\Models\admin\project_type', 'project_type');
    }

    public function ProjCat()
    {
     return $this->belongsTo('App\Models\admin\CategoryModel', 'project_category');
    }
}
