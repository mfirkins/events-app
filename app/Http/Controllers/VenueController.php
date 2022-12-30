<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $venues = Venue::all();
        return view("venues.index", ["venues" => $venues]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (Auth::check()) {
            return view('venues.create');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:App\Models\Venue,name',
            'description' => 'required|max:1000',
            'image' => 'mimes:jpg,png,jpeg|max:5048',
            'city' => 'required|max:100',
            'longitude' => 'required|numeric|between:-90, 90',
            'latitude' => 'required|numeric|between:-180, 180',

        ]);

        $accessible_request = $request->accessible;
        if ($accessible_request != null){
            if ($accessible_request == "Available"){
                $accessible = true;
            }
            else{
                $accessible = false;
            }
        }

        if ($request->image != null) {
            $imageName = time() . '_' . $request->name . '.' . $request->image->extension();
            // $request->image->move(public_path('images/venue_pictures'), $imageName);
            $request->image->storeAs('images/venue_pictures', $imageName, 'public');

        } else {
            $imageName = null;
        }

        $venue = new Venue;
        $venue->name = $validatedData['name'];
        $venue->description = $validatedData['description'];
        $venue->image_name = $imageName;
        $venue->city = $validatedData['city'];
        $venue->accessible = $accessible;
        $venue->longitude = $validatedData['longitude'];
        $venue->latitude = $validatedData['latitude'];
        $venue->user_id = Auth::id();
        $venue->save();

        session()->flash('message', "Venue, $venue->name , was successfully created");

        return redirect()->route('home');




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $venue = Venue::findOrFail($id);
        return view('venues.show', ['venue' => $venue]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}