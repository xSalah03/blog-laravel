<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        $catCount = Category::count();
        $posCount = Post::count();
        $comCount = Comment::count();
        return view('pages.admin.categories.index', compact('categories', 'catCount', 'posCount', 'comCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $catCount = Category::count();
        $posCount = Post::count();
        $comCount = Comment::count();
        return view('pages.admin.categories.create', compact('catCount', 'posCount', 'comCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'cover' => 'required|mimes:png,jpg,webp|max:4096',
        ]);

        $category = new Category();
        $category->name = $validatedData['name'];
        if ($request->hasFile('cover')) {
            $category->cover = $request->file('cover')->store('images/categories');
        }
        $category->save();
        flashy()->success('Category created successfully');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $catCount = Category::count();
        $posCount = Post::count();
        $comCount = Comment::count();
        $category = Category::findOrFail($id);
        return view('pages.admin.categories.edit', compact('category', 'catCount', 'posCount', 'comCount'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255',
            'cover' => 'mimes:png,jpg,webp|max:4096',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $validatedData['name'];
        if ($request->hasFile('cover')) {
            // Delete previous cover image if it exists
            if ($category->cover) {
                Storage::delete($category->cover);
            }

            $category->cover = $request->file('cover')->store('images/categories');
        }
        $category->save();
        flashy()->success('Category updated successfully');
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if ($category) {
            $category->delete();
            flashy()->success('Category deleted successfully');
            return redirect()->route('category.index');
        }
        return redirect()->route('category.index');
    }
}
