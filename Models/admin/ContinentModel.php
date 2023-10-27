<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContinentModel extends Model
{
    use HasFactory;

    protected $table = 'continent';
    public $timestamps = false;
    protected $guarded = []; 



}
