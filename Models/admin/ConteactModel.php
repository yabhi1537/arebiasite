<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConteactModel extends Model
{
    use HasFactory;
    
    protected $table = 'contact_details';
    public $timestamps = false;
    protected $guarded = []; 
}
