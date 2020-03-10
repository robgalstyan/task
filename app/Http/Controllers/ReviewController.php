<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request, $business_id){
        $this->validate($request, [
            'rate' => '',
            'review' => 'required'
        ]);

        $review = Review::create([
            'rate' => $request->rate,
            'text' => $request->review,
            'business_id' => $business_id,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back();
    }




    public function get(Request $request, $id)
    {
        $reviews = Review::with('user', 'comments.user')->where('business_id', $id);

        if($request->type == 'bad'){
            $reviews = $reviews->where('rate', '<', 4);
        }
        else{
            $reviews = $reviews->where('rate', '>=', 4);
        }
        $reviews = $reviews->get();

        return view('business.reviews', compact('reviews', 'id'));
    }

    public function toggle_status($review_id){
        $review  = Review::find($review_id);
        $review->status = !$review->status;
        $review->save();

        return redirect()->back();
    }





}
