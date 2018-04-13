<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allBooks = Book::all();
        $books = Book::paginate($request->paginate);
        $bookNum = $request->paginate;
        return view('home')->withBooks($books)->with('bookNum', $bookNum)->with('allBooks', $allBooks);
    }
}
