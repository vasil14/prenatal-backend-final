<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['link', 'product_id'];

    // Relation One-to-Many for Product-Gallery
    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
