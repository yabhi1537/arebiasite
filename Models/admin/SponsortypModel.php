<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\SponsorModel;

class SponsortypModel extends Model
{
    use HasFactory;

    protected $table = 'sponsorship_type';
    protected $primaryKey = 'type_id';
    public $timestamps = false;
    protected $guarded = [];
}
