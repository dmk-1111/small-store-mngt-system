<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Optional;

class Product extends Model
{
    use HasFactory;

    /**
     * Table
     */
    protected $table = 'products';

    /**
     * Fillable fields
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'created_by',
        'updated_by',
    ];

    /**
     * Relationships
     */
    public function createdBy(){
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(){
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Accessors
     */
    public function getCreatedByNameAttribute(){
        return Optional($this->createdBy)->name;
    }
    public function getUpdatedByNameAttribute(){
        return Optional($this->updatedBy)->name;
    }
}
