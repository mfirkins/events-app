<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile = Profile::findOrFail($id);
        $profile_events = $profile->events()->paginate(5);
        $profile_venues = $profile->venues()->paginate(5);
        $profile_comments = $profile->comments()->paginate(5);

        return view('profiles.show', ['profile' => $profile, 'events' => $profile_events, 'venues' => $profile_venues, 'comments' => $profile_comments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profile = Profile::findOrFail($id);
        $roles = Role::all();
        return view('profiles.edit', ['profile' => $profile, 'roles' => $roles]);
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
        $profile = Profile::findOrFail($id);
        $user = $profile->user;


        if (Auth::check() and (Auth::user() == $profile->user() or Auth::user()->hasRole('Admin'))) {
            $validateRules = [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
            ];

            if (Auth::user()->hasRole('Admin')) {
                $roleValidate = ['role' => 'required'];
                $validateRules = array_merge($validateRules, $roleValidate);
                $validatedData = $request->validate($validateRules);
                $user->assignRole($validatedData['role']);

            }
            $validatedData = $request->validate($validateRules);
            $user->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email']
            ]);

            session()->flash('message', "Profile, was successfully updated");

            return redirect()->route('profiles.show', $profile->id);
        } else {
            session()->flash('message', "You do not have permission to update this profile");

            return redirect()->route('profiles.show', $profile->id);
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
        //
    }
}