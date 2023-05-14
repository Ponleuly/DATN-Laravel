<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Likes extends Model
{
    use HasFactory;
    protected $table = 'likes';
    protected $fillable = [
        'user_id',
        'product_id',
    ];
    public function rela_product_like()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
}
