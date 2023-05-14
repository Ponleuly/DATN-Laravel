<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customers extends Model
{
    use HasFactory;
    protected $table = 'customers';
    protected $fillable = [
        'c_name',
        'c_phone',
        'c_email',
        'c_address',
        'c_note',
        'order_id',

    ];
    public function rela_customer_order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
