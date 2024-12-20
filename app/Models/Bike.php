<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'category_id', 'quantity', 'price', 'barcode', 'photo'];

    // Define the relationship with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Accessor to get the full URL for the photo
    public function getImageUrlAttribute()
    {
        return $this->photo ? asset('storage/' . $this->photo) : 'default-image.jpg';
    }
}
