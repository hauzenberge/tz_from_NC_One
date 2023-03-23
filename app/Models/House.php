<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'houses';
    protected $fillable = [
        'id',
        'name',
        'price',
        'badrooms',
        'storeys',
        'garages',
        'created_at',
        'updated_at'
    ];
}
