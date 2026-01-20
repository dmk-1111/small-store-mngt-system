<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;
    /**
     * Table
     */
    protected $table = 'order_products';

    /**
     * Define fields
     */
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];
}
