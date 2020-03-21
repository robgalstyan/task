<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Review;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Psy\VersionUpdater\Checker;



class BusinessController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
//        User::with('address')->find(1);
        return view('business.create');

    }


    public function my_businesses()
    {
        $businesses = Business::all()->where('user_id', Auth::user()->id);

        foreach ($businesses as $business){
            $total_rates = 0;
            foreach ($business->reviews as $review){
                $total_rates += $review->rate;
            }
            $business->total_rate = $total_rates;
        }

            return view('business.my_businesses', compact('businesses', 'total_rate'));


    }



    public function dashboard()
    {
        $businesses = Business::all()->where('user_id', Auth::user()->id);

        foreach ($businesses as $business){
            $every_rates = 0;
            foreach ($business->reviews as $review){
                $every_rates += $review->rate;
            }
            $business->every_rate = $every_rates;
        }


        return view('business.dashboard', compact('businesses', 'every_rate'));
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'address' => 'required|max:255'
        ]);


        // add business
        Business::create([
            'name' => $request->name,
            'address' => $request->address,
            'user_id' => Auth::user()->id
        ]);

        return redirect('business/all');

    }

    public function edit($id){
        $business = Business::find($id);
        if($business){
            return view('business.edit', compact('business'));
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|max:255',
            'address' => 'required|max:255'
        ]);

        Business::where('id', $id )->update(['name' => $request->name, 'address' => $request->address]);

        return redirect('business/my_businesses')->with('success', 'Updated successfully');
    }

    public function delete($id){
        $business = Business::find($id);
        if($business){
            $business->delete();
        }
        else{
            abort(404);
        }

        return redirect('business/my_businesses')->with('success', 'Business deleted');
    }

    public function all()
    {
        $businesses = Business::with('reviews.user')->get();

        foreach ($businesses as $business){
            $total_rates = 0;
            foreach ($business->reviews as $review){
                $total_rates += $review->rate;
            }
            $business->total_rate = $total_rates;
        }

        return view('business.all', compact('businesses'));


    }


}
