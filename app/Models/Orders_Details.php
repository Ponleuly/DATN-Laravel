<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders_Details extends Model
{
    use HasFactory;
    protected $table = 'orders_details';
    protected $fillable = [
        'order_id',
        'product_id',
        'product_price',
        'product_quantity',
        'size_id',


    ];
    public function rela_order_detail()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
    public function rela_product_order()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }
    public function rela_size_order()
    {
        return $this->belongsTo(Sizes::class, 'size_id');
    }
}
