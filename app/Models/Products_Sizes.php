<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_Sizes extends Model
{
    use HasFactory;
    protected $table = 'products_sizes';
    protected $fillable = [
        'product_id',
        'size_id',
        'size_quantity',
    ];
    public function rela_product_size()
    {
        return $this->belongsTo(Sizes::class, 'size_id'); //(Model, 'foreign_key', '[owner_key]') --owner_key not neccessary if using id as default primary key
    }
}
