<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\SponsortypModel;


class SponsorModel extends Model
{
    use HasFactory;

    protected $table = 'sponsorship';
    public $timestamps = false;
    protected $guarded = []; 

    public function sponsorTyp()
    {
     return $this->belongsTo('App\Models\admin\SponsortypModel', 'type_id');
    }



}
