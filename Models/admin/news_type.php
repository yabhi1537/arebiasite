<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\news;


class news_type extends Model
{
    use HasFactory;
    
    protected $table = 'news_type';
    protected $guarded = [];  

    protected $primaryKey = 'newstypeid';

}
