<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;
    protected $table = 'settings';
    protected $fillable = [
        'website_name',
        'home_pageSlogan',
        'home_pageText',
        'home_pageImage',
        'section_pageImage',
        'facebook_link',
        'instagram_link',
        'youtube_link',
        'tiktok_link',
    ];
}
