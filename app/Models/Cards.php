<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cards extends Model
{
    use HasFactory;
    protected $table = 'cards';
    protected $fillable = [
        'payment_id',
        'card_digit',
        'card_brand',
        'holder_name',
        'holder_email',
        'holder_phone',
        'order_code',
        'amount',
    ];
}
