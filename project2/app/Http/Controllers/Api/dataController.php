<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class dataController extends Controller
{
    public function get_categories()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
}
