<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'image'];

    // Define the relationship with bikes
    public function bikes()
    {
        return $this->hasMany(Bike::class);
    }
}
