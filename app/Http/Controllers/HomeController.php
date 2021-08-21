<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $products = Product::with(["category", "type", "user"])->get();
        $categories = Category::all();
        return view('home', ['title' => 'Home', "products" => $products, "categories" => $categories]);
    }
}
