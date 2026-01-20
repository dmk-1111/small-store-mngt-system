<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    /**
     * Table
     */
    protected $table = 'orders';

    /**
     * Define fields
     */
    protected $fillable = [
        'user_id',
        'amount',
        'status',
        'stripe_id'
    ];

    /**
     * Relationship
     */
    public function products(){
        return $this->hasMany(OrderProduct::class);
    }
}
