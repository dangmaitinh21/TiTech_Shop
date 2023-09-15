<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function cart() {
        $this->hasOne(Cart::class, 'id', 'carts_id');
    }

    public function customer() {
        $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
