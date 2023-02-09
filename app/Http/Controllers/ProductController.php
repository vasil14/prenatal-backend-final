<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    // Get all products by title using filters file
    public function index()
    {

        return Product::where('parent_id', 0)->filterBy(request()->all())->with('children')->take(10)->get();
    }
}
