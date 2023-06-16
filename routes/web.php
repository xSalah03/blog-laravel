<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $catCount = Category::count();
    $posCount = Post::count();
    $comCount = Comment::count();
    // $catCount = Category::count();
    return view('dashboard', compact('catCount', 'posCount', 'comCount'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::patch('/profile/{id}', [ProfileController::class, 'updateAvatar'])->name('profile.avatar.update');
});

Route::resource('/dashboard/category', CategoryController::class);
Route::resource('/dashboard/post', PostController::class);
Route::resource('/dashboard/comment', CommentController::class);

Route::get('/posts', [PostController::class, 'userIndex'])->name('post.user.index');
Route::get('/posts/{postId}', [PostController::class, 'userShow'])->name('post.user.show');

Route::get('/posts/{postId}/comments/', [CommentController::class, 'userCreate'])->name('comment.user.create');
Route::post('/posts/{postId}/comments', [CommentController::class, 'userStore'])->name('comment.user.store');

require __DIR__ . '/auth.php';
