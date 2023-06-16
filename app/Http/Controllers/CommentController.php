<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comment::all();
        $catCount = Category::count();
        $posCount = Post::count();
        $comCount = Comment::count();
        return view('pages.admin.comments.index', compact('comments', 'comCount', 'catCount', 'posCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $posts = Post::all();
        $catCount = Category::count();
        $posCount = Post::count();
        $comCount = Comment::count();
        return view('pages.admin.comments.create', compact('posts', 'catCount', 'posCount', 'comCount'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);
        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->post_id = $validatedData['post_id'];
        $comment->user_id = Auth::user()->id;
        $comment->save();
        flashy()->success('Comment created successfully');
        return redirect()->route('comment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $posts = Post::all();
        $comment = Comment::findOrFail($id);
        $catCount = Category::count();
        $posCount = Post::count();
        $comCount = Comment::count();
        return view('pages.admin.comments.edit', compact('comment', 'catCount', 'posCount', 'comCount', 'posts'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = Comment::findOrFail($id);
        $comment->content = $validatedData['content'];
        $comment->post_id = $validatedData['post_id'];
        
        $comment->save();
        flashy()->success('Comment updated successfully');
        return redirect()->route('comment.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $comment = Comment::findOrFail($id);
        if ($comment) {
            $comment->delete();
            flashy()->success('Comment deleted successfully');
            return redirect()->route('comment.index');
        }
        return redirect()->back();
    }

    public function userStore(Request $request, $postId)
    {
        $validatedData = $request->validate([
            'content' => 'required|max:255',
        ]);
        $comment = new Comment();
        $comment->content = $validatedData['content'];
        $comment->user_id = Auth::user()->id;
        $comment->post_id = $postId;
        $comment->save();
        flashy()->success('Comment created successfully');
        return redirect()->back();
    }

    /**
     * Show the form for creating a new comment by the user.
     */
}
