<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\news_type;


class news extends Model
{
    use HasFactory;

     protected $guarded = [];  

     protected $table = 'news';

     protected $primaryKey = 'newsid';

   protected $fillable = [
       'title',
       'publish_date',
       'category',
       'description',  
       'bannerimage',
        'newstypeid'
   ];

   public function newTyp()
   {
    return $this->belongsTo('App\Models\admin\news_type', 'newstypeid');
   }

//    public $sortable = ['id','title'];
}
