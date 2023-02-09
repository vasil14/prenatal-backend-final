<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'mpn', 'price', 'sale_price', 'vip_price', 'stock', 'availability', 'taglia', 'parent_id', 'title', 'description', 'link', 'image_link', 'product_type', 'eta', 'marche', 'genere', 'personaggi', 'colore'];

    // Relation Many-to-Many for Product-Category
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id')->withTimestamps();
    }

    // Relation One-to-Many for Product-Gallery
    public function images()
    {
        return $this->hasMany(Gallery::class);
    }


    // Relation One-to-Many inside Product table with parent_product-children_product
    public function children()
    {
        return $this->hasMany(Product::class, 'parent_id', 'id')->with('children');
    }
}
