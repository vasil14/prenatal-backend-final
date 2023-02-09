<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    // Relation One-to-Many for Category-Color
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_colors', 'category_id', 'color_id')->withTimestamps();
    }
}
