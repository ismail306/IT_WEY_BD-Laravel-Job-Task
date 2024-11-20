<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['categories'] = Category::all();
        return view('categories.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'time' => 'required|after:now',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->time = $request->time;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $data['category'] = $category;
        return view('categories.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required',
            'time' => 'required',
        ]);

        $category->name = $request->name;
        $category->time = $request->time;
        $category->save();

        return redirect()->route('categories.index')
            ->with('success', 'Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Category deleted successfully');
    }

    public function project2data()
    {
        $remoteServerUrl = env('REMOTE_SERVER_URL');
        $response = Http::get($remoteServerUrl . '/api/get_categories');
        //dd($response->json());

        $categories = $response->json();
        $currentDateTime = Carbon::now('Asia/Dhaka')->format('Y-m-d H:i:s');
        foreach ($categories as $category) {
            //categoryTime will be format('Y-m-d H:i:s')
            $categoryTime = Carbon::parse($category['time'])->format('Y-m-d H:i:s');
            //compare category time with current time
            // dd($categoryTime, $category['name']);

            // Check if category time is less than or equal to current time
            if ($categoryTime <= $currentDateTime) {
                $existingCategory = Category::where('name', $category['name'])
                    ->where('time', $category['time'])
                    ->first();

                if ($existingCategory) {
                    // dd('Category already exists');
                } else {
                    // Create a new category in Project 1's database
                    //dd($category);
                    $newCategory = new Category();
                    $newCategory->name = $category['name'];
                    $newCategory->time = $category['time'];
                    $newCategory->save();
                }
            }
        }
    }
}
