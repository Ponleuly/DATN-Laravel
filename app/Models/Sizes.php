<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    protected $fillable = ['size_number'];
    public function rela_product_size()
    {
        return $this->hasMany(Products_Sizes::class, 'size_id', 'id'); // ('Model', 'foreign_key', 'local_key');
    }
    public function rela_size_order()
    {
        return $this->hasMany(Orders_Details::class, 'size_id', 'id'); // ('Model', 'foreign_key', 'local_key');
    }
}
