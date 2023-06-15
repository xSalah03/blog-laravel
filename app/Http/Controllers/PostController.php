<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use DragonCode\Contracts\Cashier\Auth\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        $catCount = Category::count();
        $posCount = Post::count();
        return view('pages.admin.posts.index', compact('posts', 'catCount', 'posCount'));
    }

    public function create()
    {
        $categories = Category::all();
        $catCount = Category::count();
        $posCount = Post::count();
        return view('pages.admin.posts.create', compact('categories', 'catCount', 'posCount'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:255',
            'cover' => 'required|mimes:png,jpg,webp|max:4096',
            'category_id' => 'required|exists:categories,id',
        ]);
        $post = new Post();
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        if ($request->hasFile('cover')) {
            $post->cover = $request->file('cover')->store('images/posts');
        }
        $post->user_id = Auth()->user()->id;
        $post->category_id = $validatedData['category_id'];
        $post->save();
        flashy()->success('Post created successfully');
        return redirect()->route('post.index');
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
        $categories = Category::all();
        $post = Post::findOrFail($id);
        $catCount = Category::count();
        $posCount = Post::count();
        return view('pages.admin.posts.edit', compact('post', 'catCount', 'posCount', 'categories'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:255',
            'cover' => 'mimes:png,jpg,webp|max:4096',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post = Post::findOrFail($id);
        $post->title = $validatedData['title'];
        $post->description = $validatedData['description'];
        $post->category_id = $validatedData['category_id'];
        if ($request->hasFile('cover')) {
            // Delete previous cover image if it exists
            if ($post->cover) {
                Storage::delete($post->cover);
            }

            $post->cover = $request->file('cover')->store('images/posts');
        }
        $post->save();
        flashy()->success('Post updated successfully');
        return redirect()->route('post.index');
    }

    public function destroy(string $id)
    {
        $post = Post::findOrFail($id);
        if ($post) {
            $post->delete();
            flashy()->success('Post deleted successfully');
            return redirect()->route('post.index');
        }
        return redirect()->route('post.index');
    }

    public function userIndex()
    {
        $posts = Post::all();
        return view('pages.user.posts.index', compact('posts'));
    }
}