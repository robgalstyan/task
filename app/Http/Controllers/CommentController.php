<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        $this->validate($request, [
            'review' => 'required',
            'review_id' => 'required'
        ]);

        $comment = Comment::create([
            'review_id' => $request->review_id,
            'user_id' => Auth::user()->id,
            'text' => $request->review
        ]);

        return redirect()->back();
    }
}
