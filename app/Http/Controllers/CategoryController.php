<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function show(Category $category) //les articles de la catégorie
    {
        $articles = $category->articles()->latest()->paginate(5);
        dd($articles);
    }
}
