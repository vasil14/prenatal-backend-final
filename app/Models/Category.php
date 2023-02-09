<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['_id', 'name', 'parent_id'];

    // Relation Many-to-Many for Product-Category
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category',  'product_id', 'category_id')->withTimestamps();
    }
}
