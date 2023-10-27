<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEnquiriesModel extends Model
{
    use HasFactory; 

    protected $table = 'contact_us';
    public $timestamps = false;
    protected $guarded = []; 
}
