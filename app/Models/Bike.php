<?php

// Bike.php (Model)

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'category_id', 'quantity', 'price'];

    // Define the relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class); // This means each bike belongs to one category
    }
}
