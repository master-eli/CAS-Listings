<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Listing;
use App\User;
use App\Role;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'counter']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listings = Listing::orderBy('created_at', 'DESC')->where('condemn', 0)->paginate(10);
        $listing_count = Listing::where('condemn', 0)->count();
        $condemn_count = Listing::where('condemn', 1)->count();
        $total = $listing_count + $condemn_count;
        if(count($listings) > 0) {
            $condemnPercentage = ( (100 * $condemn_count) / ($listing_count + $condemn_count) );
            $listingPercentage = ( (100 * $listing_count) / ($listing_count + $condemn_count) );
            $counter= array_count_values(Listing::where('condemn', 0)->get()->pluck('user_id')->toArray());
            $roles = DB::table('roles')->join('users', 'roles.id', '=', 'users.role_id')->where('role', '!=', 'Dean`s Office')->get()->pluck('role')->toArray();
            $dean = Role::where('role', 'Dean`s Office')->select('id')->pluck('id')->toArray();
            $total_user = User::where('role_id', '!=', $dean)->count();
        }
    
        // return view('home', compact('listings','condemnPercentage', 'listing_count', 'condemn_count', 'users', 'counter', 'total_user', 'total', 'listingPercentage', 'roles', 'role'));
        return view('home', compact('listings','condemnPercentage', 'listing_count', 'condemn_count', 'counter', 'total_user', 'total', 'listingPercentage', 'roles'));
    }

}
