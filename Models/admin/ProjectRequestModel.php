<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRequestModel extends Model
{
    use HasFactory;

    protected $table = 'tbl_project_request';
    protected $primaryKey = 'request_id';
    public $timestamps = false;
    protected $guarded = []; 
}
