<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories_Groups extends Model
{
    use HasFactory;
    protected $table = 'categories_groups';
    protected $fillable = [
        'category_id',
        'group_id'
    ];
    public function rela_category_group()
    {
        return $this->belongsTo(Groups::class, 'group_id');
    }
    public function rela_category()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }
    public function rela_product_group()
    {
        return $this->hasOne(Products::class, 'id');
    }
}
