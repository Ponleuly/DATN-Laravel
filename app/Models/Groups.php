<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;
    protected $table = 'groups';
    protected $fillable = ['group_name'];
    public function rela_category_group()
    {
        return $this->hasMany(Categories_Groups::class, 'group_id', 'id');
    }
    public function rela_product_group()
    {
        return $this->hasMany(Products_Attributes::class, 'group_id', 'id');
    }
}
