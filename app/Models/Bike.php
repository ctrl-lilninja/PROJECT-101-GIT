<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bike extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'model', 'category_id', 'quantity', 'price'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}