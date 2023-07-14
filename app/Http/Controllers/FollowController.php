<?php

namespace App\Http\Controllers;

use App\Models\Follower;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function index()
    {
        $userId = auth()->user()->id;
        $followRequests = Follower::where('follower_id', $userId)
            ->where('status', 'pending')
            ->get();
        return view('pages.user.users.index', compact('followRequests'));
    }

    public function store(Request $request)
    {
        $followerId = $request->input('follower_id');
        $userId = auth()->user()->id;
        Follower::create([
            'follower_id' => $followerId,
            'user_id' => $userId,
            'status' => 'pending',
        ]);

        return redirect()->back();
    }

    public function confirm($id)
    {
        $follower = Follower::findOrFail($id);
        $follower->status = 'confirmed';
        $follower->save();

        return redirect()->back();
    }

    public function decline($id)
    {
        $follower = Follower::findOrFail($id);
        $follower->delete();

        return redirect()->back();
    }
}
