<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories_Subcategories extends Model
{
    use HasFactory;
    protected $table = 'categories_subcategories';
    protected $fillable = [
        'sub_category',
        'category_id',
    ];
    public function rela_product_subcategory()
    {
        return $this->hasMany(Products_Attributes::class, 'id');
    }
    public function rela_category_subcategory()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
}
