<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarketerModel extends Model
{
    use HasFactory;
    protected $table = 'marketer';
    public $timestamps = false;
    protected $guarded = [];


}
