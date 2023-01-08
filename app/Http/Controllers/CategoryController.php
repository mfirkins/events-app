<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
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
        if (Auth::check() and Auth::user()->hasRole('Admin')) {
            return view('categories.create');
        } else {
            session()->flash('message', "You do not have permission to create categories");

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
        if ((Auth::check() and Auth::user()->hasRole('Admin'))) {
            $validatedData = $request->validate([
                'name' => 'required|max:1000',
            ]);

            $category = new Category();
            $category->name = $validatedData['name'];
            $category->profile_id = Auth::user()->profile->id;
            $category->save();

            session()->flash('message', "Category, $category->name , was successfully created");

            return redirect()->route('home');

        } else {
            session()->flash('message', "You do not have permission to create a category");

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
        $category = Category::findOrFail($id);
        $category_events = $category->events()->paginate(20);

        return view('categories.show', ['category' => $category, 'events' => $category_events]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', ['category' => $category]);
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
        $category = Category::findOrFail($id);


        if (Auth::check() and (Auth::user() == $category->profile->user or Auth::user()->hasRole('Admin'))) {
            $validateRules = [
                'name' => 'required|max:255',
            ];

            $validatedData = $request->validate($validateRules);
            $category->update([
                'name' => $validatedData['name'],
            ]);

            session()->flash('message', "Category, was successfully updated");

            return redirect()->route('categories.show', $category->id);
        } else {
            session()->flash('message', "You do not have permission to update this category");

            return redirect()->route('categories.show', $category->id);
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
        $category = Category::findOrFail($id);

        if ((Auth::check() and Auth::user()->hasRole('Admin'))) {

            $category->delete();

            session()->flash('message', "Category, $category->name , was successfully deleted");

            return redirect()->route('home');
        } else {
            session()->flash('message', "You do not have permission to delete this category");

            return redirect()->route('home');
        }
    }
}