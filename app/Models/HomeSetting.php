<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'contact_email',
        'admin_mails',
        'logo',
        'address',
        'phone',
        'fax',
        'map_location',
        'working_hours',
        'meta_title',
        'meta_description',
        'keywords',
    ];
}
