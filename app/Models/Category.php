<?php

// Category.php (Model)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Define the relationship with bikes
    public function bikes()
    {
        return $this->hasMany(Bike::class); // This will fetch all bikes associated with this category
    }
}

