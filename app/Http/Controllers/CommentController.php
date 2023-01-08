<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Notifications\CommentLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Response;

class CommentController extends Controller
{

    public function liked(Request $request)
    {
        $comment = Comment::findOrFail($request->comment_id);
        $comment->likes++;
        $comment->save();
        $user = $comment->profile->user;
        Notification::send($user, new CommentLiked($comment->event->id));
        return redirect()->route("events.show", $comment->event->id);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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
        if ((Auth::check() and Auth::user()->hasRole(['Visitor', 'Verified Venue', 'Admin']))) {
            $validatedData = $request->validate([
                'content' => 'required|max:1000',
                'event_id' => 'required'
            ]);

            $event_id = $validatedData['event_id'];

            $comment = new Comment();
            $comment->content = $validatedData['content'];
            $comment->profile_id = Auth::user()->profile->id;
            $comment->event_id = $event_id;
            $comment->likes = 0;
            $comment->save();

            return Response::json($comment);
        } else {

            return Response::json(['error' => 'You are not authorized to create a comment'], 403);
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
        $comment = Comment::findOrFail($id);
        return view('comments.show', ['comment' => $comment]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::findOrFail($id);
        return view('comments.edit', ['comment' => $comment]);
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
        $comment = Comment::findOrFail($id);

        if (Auth::check() and (Auth::user() == $comment->profile->user or Auth::user()->hasRole('Admin'))) {
            $validateRules = [
                'content' => 'required|max:255',
            ];

            $validatedData = $request->validate($validateRules);
            $comment->update([
                'content' => $validatedData['content'],
            ]);

            session()->flash('message', "Comment, was successfully updated");

            return redirect()->route('events.show', $comment->event->id);
        } else {
            session()->flash('message', "You do not have permission to update this comment");

            return redirect()->route('events.show', $comment->event->id);
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
        $comment = Comment::findOrFail($id);

        if ((Auth::check() and (Auth::user() == $comment->profile->user or Auth::user()->hasRole('Admin')))) {

            $comment->delete();

            session()->flash('message', "Comment was successfully deleted");

            return redirect()->route('home');
        } else {
            session()->flash('message', "You do not have permission to delete this comment");

            return redirect()->route('home');
        }
    }
}