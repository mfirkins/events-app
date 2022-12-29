<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Venue;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('events.index', ['events' => $events]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $venues = Venue::all();
        if (Auth::check()){
            return view('events.create', ['categories' => $categories, 'venues' => $venues]);
        }
        else{
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
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'image' => 'mimes:jpg,png,jpeg|max:5048',
            'city' => 'required|max:100',
            'longitude' => 'required|numeric|between:-90, 90',
            'latitude' => 'required|numeric|between:-180, 180',

        ]);

        if ($request->image != null) {
            $imageName = time() . '_' . $request->name . '.' . $request->image->extension();
            $request->image->storeAs('images/venue_pictures', $imageName, 'public');

        } else {
            $imageName = null;
        }

        $venue = new Venue;
        $venue->name = $validatedData['name'];
        $venue->description = $validatedData['description'];
        $venue->image_name = $imageName;
        $venue->city = $validatedData['city'];
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
        $event = Event::findOrFail($id);

        return view('events.show', ['event' => $event]);
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