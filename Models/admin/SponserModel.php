<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SponserModel extends Model
{
    use HasFactory;

    protected $table = 'sponsor_show';
    public $timestamps = false;
    protected $guarded = []; 
}
