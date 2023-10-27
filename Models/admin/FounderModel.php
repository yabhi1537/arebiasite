<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FounderModel extends Model
{
    use HasFactory;

    protected $table = 'founder_of_associativ';
    public $timestamps = false;
    protected $guarded = []; 
}
