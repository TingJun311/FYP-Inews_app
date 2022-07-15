<?php

namespace App\Http\Controllers;

use App\Models\Bookmarks;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    // public function getUsersBookmark() {
    //     return view('users.bookmark', [
    //         'bookmarks' => Bookmarks::all()
    //     ]);
    // }

    public function store(Request $request) {
        
        Bookmarks::create([
            'user_id' => auth()->id(),
            'author' => $request->author,
            'title' => $request->title,
            'description' => $request->text,
            'url' => $request->url,
            'urlToImage' => $request->image,
        ]);
        return response()->json($request->all());
    }

    public function show() {
        return view('users.bookmark', [
            'bookmark' => auth()->user()->bookmarks()->get()
        ]);
    }
}
