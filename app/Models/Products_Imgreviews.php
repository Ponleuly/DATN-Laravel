<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products_Imgreviews extends Model
{
    use HasFactory;
    protected $table = 'products_imgreviews';
    protected $fillable = [
        'product_imgreview',
        'product_id',
    ];
    public function pro_img()
    {
        return $this->belongsTo(Product_details::class, 'product_id');
    }
}
