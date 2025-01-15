<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index(){
        $posts= Post::get();
        return view('posts', compact('posts'));

    }


    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'body' => 'required',
            'email' => 'required',
        ]);
        if ($validator->fails()) {

            return response()->json([
            'error' => $validator->errors()->all()
         ]);
        }
        // dd($request->all());
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'email' => $request->email,
        ]);
        return response()->json(['success' => 'Post created successfully.']);

    }
}
