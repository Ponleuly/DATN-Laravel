<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'invoice_code',
        'order_status',
        'user_id',
        'discount',
        'payment_method',
        'delivery_fee',
        'total_paid'

    ];
    public function rela_order_detail()
    {
        return $this->hasOne(Orders_Details::class, 'id');
    }
    public function rela_customer_order()
    {
        return $this->hasOne(Customers::class, 'id');
    }
    public function rela_order_status()
    {
        return $this->belongsTo(Orders_Statuses::class, 'order_status');
    }
}
