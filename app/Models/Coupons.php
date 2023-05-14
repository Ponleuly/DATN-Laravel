<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupons extends Model
{
    use HasFactory;
    protected $table = 'coupons';
    protected $fillable = [
        'campaign_name',
        'code',
        'discount_percentage',
        'discount_value',
        'start_date',
        'end_date',
        'category_id',
        'subcategory_id',
        'coupon_status'
    ];
}
