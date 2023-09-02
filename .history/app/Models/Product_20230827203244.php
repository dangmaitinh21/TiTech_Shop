<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'description',
        'content',
        'category_id',
        'price',
        'price_sale',
        'active',
    ];

    public function category() {
        return $this->hasOne(Categories::class, 'id', 'category_id')->withDefault(['name'=>'']);
    }
}
