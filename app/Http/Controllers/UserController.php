<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function userShow(string $id)
    {
        $user = User::withCount('posts')->findOrFail($id);
        $followingCount = $user->following()->where('status', 'confirmed')->count();
        $followersCount = $user->followers()->where('status', 'confirmed')->count();
        $followers = auth()->user()->following;
        $isFollowing = $followers->contains('follower_id', $id);
        $follower = $followers->where('follower_id', $id)->first();
        return view('pages.user.users.show', compact('user', 'followersCount', 'followingCount', 'isFollowing', 'follower'));
    }
}
