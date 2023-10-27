<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberOfBoardModel extends Model
{
    use HasFactory;

    protected $table = 'member_of_board';
    public $timestamps = false;
    protected $guarded = []; 
}
