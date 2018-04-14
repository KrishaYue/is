<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Session;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'                   =>               'required',
            'author'                  =>               'required',
            'date_published'          =>               'required|date|before:tomorrow'
        ]);

        $book = New Book;

        $book->title = $request->title;
        $book->author = $request->author;
        $book->date_published = $request->date_published;
        $book->availability = $request->has('available');
        $book->save();

        Session::flash('success', 'Book successfully added.');
        return redirect()->route('home');
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function paginatebooks(Request $request)
    {
        //$items = 10;
        //$books = Book::paginate($items);
        //return view('books.index')
            //  ->with('books', $books);
        //$allBooks = Book::all();
        //$books = Book::paginate(2);
        //$bookNum = $request->paginate;
        //return view('books.index')->withBooks($books)->with('allBooks', $allBooks);
    }
}
