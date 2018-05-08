<?php

namespace ICTDUInventory\Http\Controllers;

use Illuminate\Http\Request;
use ICTDUInventory\Book;


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
        /*
        $allBooks = Book::all();
        $books = Book::paginate(1);
        return view('home')->withBooks($books)->with('allBooks', $allBooks);
        http://localhost:8000/home?page=2
        */
        $day30 = \Carbon\Carbon::today()->subDays(30);

        $isActive = $request->get('page', 1);
        $page = 1;
        $allBooks = Book::all();
        $items = $request->items ?? 10;
        $books = Book::orderBy('year_published','asc')->paginate($items);
        //$books = Book::paginate($items);
        //$books->withPath('custom/url');

        return view('home')
              ->with('books', $books)
              ->with('items', $items)
              ->with('allBooks', $allBooks)
              ->with('page', $page)
              ->with('isActive', $isActive)
              ->with('day30', $day30);
    }

    public function searchBook(Request $request)
    {
        $day30 = \Carbon\Carbon::today()->subDays(30);
        $isActive = $request->get('page', 1);
        $page = 1;
        $allBooks = Book::where( 'id', 'LIKE', '%' . $request->quary . '%' )->orWhere( 'title', 'LIKE', '%' . $request->quary . '%' )->orWhere( 'author', 'LIKE', '%' . $request->quary . '%' );
        $allBooks2 = Book::all();
        $items = $request->items ?? 10;
        $books = Book::where( 'id', 'LIKE', '%' . $request->quary . '%' )->orWhere( 'title', 'LIKE', '%' . $request->quary . '%' )->orWhere( 'author', 'LIKE', '%' . $request->quary . '%' )->orderBy('year_published', 'asc')->paginate($items);
        $searchValue = $request->quary;
        //$books = Book::paginate($items);
        //$books->withPath('custom/url');
        if ($allBooks->count() > 0) {
            return view('books.search')
              ->with('books', $books)
              ->with('items', $items)
              ->with('allBooks', $allBooks)
              ->with('allBooks2', $allBooks2)
              ->with('page', $page)
              ->with('searchValue', $searchValue)
              ->with('isActive', $isActive)
              ->with('day30', $day30);
        }
        else {
            return view('books.search')
              ->with('quary_msg', $searchValue)
              ->with('books', $books)
              ->with('items', $items)
              ->with('allBooks', $allBooks)
              ->with('allBooks2', $allBooks2)
              ->with('page', $page)
              ->with('searchValue', $searchValue)
              ->with('isActive', $isActive)
              ->with('day30', $day30);
        }
        
    }

    
}
