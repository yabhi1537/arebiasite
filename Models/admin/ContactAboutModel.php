<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAboutModel extends Model
{
    use HasFactory;

    protected $table = 'contact_about';
    public $timestamps = false;
    protected $guarded = []; 
}
