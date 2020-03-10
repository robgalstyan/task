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
        return view('business.create');

    }


    public function my_businesses()
    {
        $businesses = Business::all()->where('user_id', Auth::user()->id);
        $rate = DB::table('reviews')->where('user_id', Auth::user()->id )->avg('rate');

        return view('business.my_businesses', ['businesses'=>$businesses, 'rate'=>$rate]);
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'address' => 'required'
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
            'name' => 'required',
            'address' => 'required'
        ]);

        Business::where('id', $id )->update(['name' => $request->name, 'address' => $request->address]);

        return redirect('business/all')->with('success', 'Updated successfully');
    }

    public function delete($id){
        $business = Business::find($id);
        if($business){
            $business->delete();
        }
        else{
            abort(404);
        }

        return redirect('business/all')->with('success', 'Business deleted');
    }

    public function all()
    {
        $businesses = Business::with('reviews.user')->get();

//        $rates = Business::with('reviews.business')->get();
//        foreach ($rates as $rate)
//        {
//            echo $rate->rate;
//        }

        return view('business.all', compact('businesses', 'rates'));

    }


}
