<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function customer() {
        $this->hasOne(Customer::class, 'id', 'customer_id');
    }
}
