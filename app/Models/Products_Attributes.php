<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_Attributes extends Model
{
    use HasFactory;
    protected $table = 'products_attributes';
    protected $fillable = [
        'product_id',
        'subcategory_id',
        'category_id',
        'group_id',

    ];
    public function rela_group()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function rela_product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function rela_product_group()
    {
        return $this->belongsTo(Groups::class, 'group_id');
    }
    public function rela_product_category()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
    public function rela_product_subcategory()
    {
        return $this->belongsTo(Categories_Subcategories::class, 'subcategory_id', 'id');
    }
}
