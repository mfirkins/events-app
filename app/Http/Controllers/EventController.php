<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Venue;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Carbon;
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
        if (Auth::check()) {
            return view('events.create', ['categories' => $categories, 'venues' => $venues]);
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
        $validateRules = [
            'name' => 'required|max:255',
            'description' => 'required|max:1000',
            'image' => 'mimes:jpg,png,jpeg|max:5048',
            'date' => 'required|date|after:today',
            'amount' => 'required|numeric|between: 1, 100000',
            'cost' => 'required|numeric|decimal:2|between:0, 10000',
        ];
        $hostValidate = ['host' => 'required|max:255'];

        if ($request['use_user'] == null) {
            array_merge($validateRules, $hostValidate);
            $validatedData = $request->validate($validateRules);
            $host_name = $validatedData['host'];
        } else {
            $validatedData = $request->validate($validateRules);
            $host_name = Auth::user()->name;
        }
        
        if ($request->image != null) {
            $imageName = time() . '_' . $request->name . '.' . $request->image->extension();
            $request->image->storeAs('images/event_pictures', $imageName, 'public');

        } else {
            $imageName = null;
        }

        $datetime = $validatedData['date'] . ' ' . $request['time'];

        $event = new Event;
        $event->name = $validatedData['name'];
        $event->description = $validatedData['description'];
        $event->image_name = $imageName;
        $event->time = Carbon::parse($datetime)->toDateTime();
        $event->user_id = Auth::id();
        $event->venue_id = Venue::where('name', $request['venue'])->get()->first()->id;
        $event->host = $host_name;
        $event->cost = $validatedData['cost'];
        $event->tickets = $validatedData['amount'];
        $event->save();

        session()->flash('message', "Event, $event->name , was successfully created");

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