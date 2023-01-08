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
        $events = Event::orderBy('time')->paginate(10);
        return view('events.index', ['events' => $events]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::check() and Auth::user()->hasRole(['Visitor', 'Verified Venue', 'Admin'])) {
            $categories = Category::all();
            $venues = Venue::all();
            return view('events.create', ['categories' => $categories, 'venues' => $venues]);
        } else {
            session()->flash('message', "You do not have permission to create events");

            return redirect()->route('home');
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
        if (Auth::check() and Auth::user()->hasRole(['Visitor', 'Verified Venue', 'Admin'])) {
            $validateRules = [
                'name' => 'required|max:255',
                'description' => 'required|max:1000',
                'image' => 'mimes:jpg,png,jpeg|max:5048',
                'date' => 'required|date|after:today',
                'selected-categories' => 'required',
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

            $categories = $validatedData['selected-categories'];
            $categories = explode(',', $categories);
            $categories = array_filter($categories);


            $datetime = $validatedData['date'] . ' ' . $request['time'];

            $event = new Event;
            $event->name = $validatedData['name'];
            $event->description = $validatedData['description'];
            $event->image_name = $imageName;
            $event->time = Carbon::parse($datetime)->toDateTime();
            $event->profile_id = Auth::user()->profile->id;
            $event->venue_id = Venue::where('name', $request['venue'])->get()->first()->id;
            $event->host = $host_name;
            $event->cost = $validatedData['cost'];
            $event->tickets = $validatedData['amount'];
            $event->save();
            foreach ($categories as $category) {
                $event->categories()->attach(Category::where('name', $category)->get()->first()->id);
            }



            session()->flash('message', "Event, $event->name , was successfully created");

            return redirect()->route('home');
        } else {
            session()->flash('message', "You do not have permission to create an event");

            return redirect()->route('home');
        }
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
        $event_comments = $event->comments()->paginate(5);

        return view('events.show', ['event' => $event, 'comments' => $event_comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::findOrFail($id);
        if (Auth::check() and (Auth::user() == $event->profile->user or Auth::user()->hasRole('Admin'))) {
            return view('events.edit', ['event' => $event]);
        } else {
            session()->flash('message', "You do not have permission to edit an event");

            return redirect()->route('home');
        }
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
        $event = Event::findOrFail($id);
        if (Auth::check() and (Auth::user() == $event->profile->user or Auth::user()->hasRole('Admin'))) {

            $validateRules = [
                'name' => 'required|max:255',
                'description' => 'required|max:2000',
                'amount' => 'required|numeric|between: 1, 100000',
                'cost' => 'required|numeric|decimal:2|between:0, 10000',
            ];

            $validatedData = $request->validate($validateRules);
            
            $event->update([
                'name' => $validatedData['name'],
                'description' => $validatedData['description'],
                'cost' => $validatedData['cost'],
                'tickets' => $validatedData['amount']
            ]);

            session()->flash('message', "Event, $event->name , was successfully updated");

            return redirect()->route('home');
        } else {
            session()->flash('message', "You do not have permission to update an event");

            return redirect()->route('home');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ((Auth::check() and (Auth::user() == $event->profile->user or Auth::user()->hasRole('Admin')))) {

            $event->delete();

            session()->flash('message', "Event, $event->name , was successfully deleted");

            return redirect()->route('home');
        } else {
            session()->flash('message', "You do not have permission to delete this event");

            return redirect()->route('home');
        }
    }
}