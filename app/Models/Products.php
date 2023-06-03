<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = [
        'product_name',
        'product_code',
        'product_des',
        'product_imgcover',
        'product_price',
        'product_saleprice',
        'product_color',
        'product_colorname',
        'product_status',

    ];
    public function pro_img()
    {
        return $this->hasMany(Product_images::class, 'product_id', 'id');
    }

    public function rela_product_size()
    {
        return $this->hasMany(Products_Sizes::class, 'product_id', 'id'); // ('Model', 'foreign_key', 'local_key');
    }
    public function rela_group()
    {
        return $this->hasMany(Products_Groups::class, 'product_id');
    }
    public function rela_product_like()
    {
        return $this->hasMany(likes::class, 'product_id');
    }
    public function rela_product_cart()
    {
        return $this->hasMany(Carts::class, 'product_id');
    }
    public function rela_product_order()
    {
        return $this->hasMany(Orders_Details::class, 'product_id', 'id');
    }
}
