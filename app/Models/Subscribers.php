<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribers extends Model
{
    use HasFactory;
    protected $table = 'subscribers';
    protected $fillable = [
        's_name',
        's_email',
    ];
}
