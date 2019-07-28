<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Listing;
use App\Role;
use Gate;
use DB;
use Validator;

class ListingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Gate::allows('isAdmin')) {

            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $role = Role::select('role')->find($user->role_id)->role;

            $listings = Listing::sortable()->where('condemn', 0)->paginate(20);

            return view('pages.index', compact('listings', 'role'));
        } else {
            
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $role = Role::select('role')->find($user->role_id)->role;
            
            $listings = Listing::sortable()->where('user_id', '=', $user->id)->where('condemn', 0)->paginate(20);

            return view('pages.index', compact('listings', 'role'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'inventory_no' => 'required',
            'quantity' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {

            $listing = new Listing;
            $listing->inventory_no = $request->input('inventory_no');
            $listing->quantity = $request->input('quantity');
            $listing->cost = $request->input('cost');
            $listing->description = $request->input('description');
            $listing->date = $request->input('date');
            $listing->condemn = $request->input('condemn');
            $listing->reason = $request->input('reason');
            $listing->user_id = auth()->user()->id;

            $listing->save();

            return response()->json($listing);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($listing_id)
    {
        $listing = Listing::find($listing_id);
        return response()->json($listing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($listing_id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $listing_id)
    {

        $listing = Listing::find($listing_id);

        $validator = Validator::make($request->all(), [
            'inventory_no' => 'required',
            'quantity' => 'required',
            'cost' => 'required',
            'description' => 'required',
            'date' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()]);
        } else {
        
            $listing->inventory_no = $request->input('inventory_no');
            $listing->quantity = $request->input('quantity');
            $listing->cost = $request->input('cost');
            $listing->description = $request->input('description');
            $listing->date = $request->input('date');
            $listing->condemn = $request->input('condemn');
            $listing->reason = $request->input('reason');
            $listing->user_id = auth()->user()->id;
    
            $listing->save();
    
            return response()->json($listing);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($listing_id)
    {
        $listing = Listing::find($listing_id);
        $listing->delete();
        return response()->json($listing);
    }

    public function condemn() {
        if(Gate::allows('isAdmin')) {
            $listings = Listing::sortable()->where('condemn', 1)->paginate(20);

            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            $role = Role::select('role')->find($user->role_id)->role;

            return view('pages.condemn', compact('listings', 'role'));
        } else {
            
            $user_id = auth()->user()->id;
            $user = User::find($user_id);

            $role = Role::select('role')->find($user->role_id)->role;
            $listings = Listing::sortable()->where('user_id', '=', $user->id)->where('condemn', 1)->paginate(20);

            return view('pages.condemn', compact('listings', 'role'));
        }
    }

    public function search(Request $request) {
        if(Gate::allows('isAdmin')) {
            if($request->ajax()) {
                $output = '';
                $listings = Listing::where( 'description', 'LIKE', '%'.$request->search.'%' )
                                    ->where('condemn', 0)
                                    ->get();
    
                if($listings) {
                    foreach($listings as $listing) {
                        $output .= '<tr class="alternate" id="listing' .$listing->id. '">'
                                . '<td>' .$listing->inventory_no. '</td>'
                                . '<td>' .$listing->quantity. '</td>'
                                . '<td>' .$listing->cost. '</td>'
                                . '<td>' .$listing->cost * $listing->quantity. '</td>'
                                . '<td>' .$listing->description. '</td>'
                                . '<td>' .$listing->date. '</td>'
                                . '<td>' .$listing->role->role. '</td>'
                                . '</tr>';
                    }
                }
                return response()->json($output);
            }
        } 
        else {
            if($request->ajax()) {
                $output = '';
                $user_id = auth()->user()->id;
                $user = User::find($user_id);
                $listings = Listing::where('user_id', '=', $user->id)->where('condemn', 0)->where( 'description', 'LIKE', '%'.$request->search.'%' )->get();
    
                if($listings) {
                    foreach($listings as $listing) {
                        $output .= '<tr class="alternate" id="listing' .$listing->id. '">'
                                . '<td>' .$listing->inventory_no. '</td>'
                                . '<td>' .$listing->quantity. '</td>'
                                . '<td>' .$listing->cost. '</td>'
                                . '<td>' .$listing->cost * $listing->quantity. '</td>'
                                . '<td>' .$listing->description. '</td>'
                                . '<td>' .$listing->date. '</td>'
                                . '<td width="5px" class="d-print-none">' .
								    '<button class="btn btn-info btn-sm open-modal" value="'.$listing->id.'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></button>'
                                    .'</td>'
                                . '<td width="5px" class="d-print-none">'
                                    .'<button class="btn btn-danger btn-sm btn-delete" value="'.$listing->id.'" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash-alt"></i></button>'
                                    .'</td>'
                                . '<td width="5px" class="d-print-none">'
                                    .'<button class="btn btn-warning btn-sm btn-condemn" value="'.$listing->id.'" data-toggle="tooltip" data-placement="top" title="Condemn"><i class="fas fa-minus-circle"></i></button>'
                                    .'</td>'
                                . '</tr>';
                    }
                }
                return response()->json($output);
            }
        }
    }

    public function searchC(Request $request) {
        if(Gate::allows('isAdmin')) {
            if($request->ajax()) {
                $output = '';
                $listings = Listing::where( 'description', 'LIKE', '%'.$request->searchCondemn.'%' )
                                    ->where('condemn', 1)
                                    ->get();
    
                if($listings) {
                    foreach($listings as $listing) {
                        $output .= '<tr class="alternate test" data-toggle="tooltip" data-placement="top" title="'.$listing->reason .'">'
                                . '<td>' .$listing->inventory_no. '</td>'
                                . '<td>' .$listing->quantity. '</td>'
                                . '<td>' .$listing->cost. '</td>'
                                . '<td>' .$listing->cost * $listing->quantity. '</td>'
                                . '<td>' .$listing->description. '</td>'
                                . '<td>' .$listing->date. '</td>'
                                . '<td>' .$listing->role->role. '</td>'
                                . '</tr>';
                    }
                }
                return response()->json($output);
            }
        } 
        else {
            if($request->ajax()) {
                $output = '';
                $user_id = auth()->user()->id;
                $user = User::find($user_id);
                $listings = Listing::where('user_id', '=', $user->id)->where('condemn', 1)->where( 'description', 'LIKE', '%'.$request->searchCondemn.'%' )->get();
    
                if($listings) {
                    foreach($listings as $listing) {
                        $output .= '<tr class="alternate test" data-toggle="tooltip" data-placement="top" title="'.$listing->reason .'">'
                                . '<td>' .$listing->inventory_no. '</td>'
                                . '<td>' .$listing->quantity. '</td>'
                                . '<td>' .$listing->cost. '</td>'
                                . '<td>' .$listing->cost * $listing->quantity. '</td>'
                                . '<td>' .$listing->description. '</td>'
                                . '<td>' .$listing->date. '</td>'
                                . '</tr>';
                    }
                }
                return response()->json($output);
            }
        }
    }

}
