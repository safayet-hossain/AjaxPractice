<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function index()

    {

        return view('searchDemo');

    }



    /**

     * Show the form for creating a new resource.

     *

     * @return \Illuminate\Http\Response

     */

     public function autocomplete(Request $request)
     {
         $query = $request->get('query');
         $posts = Post::where('title', 'LIKE', '%' . $query . '%')
                      ->get(['id', 'title', 'body', 'email']);

         return response()->json($posts);
     }
}
