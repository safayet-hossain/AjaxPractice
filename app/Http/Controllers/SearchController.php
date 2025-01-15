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
         $data = Post::where('title', 'LIKE', '%' . $request->query('query') . '%')
                     ->pluck('title'); // Returns only title as an array
         return response()->json($data);
     }
}
