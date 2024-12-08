<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SoldBike extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id', 
        'bike_id', 
        'quantity',
    ];

    // Define the relationship with the Bike model
    public function bike()
    {
        return $this->belongsTo(Bike::class);
    }

    // Define the relationship with the Sale model
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
}
