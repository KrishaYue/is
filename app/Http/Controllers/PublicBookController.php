<?php

namespace ICTDUInventory\Http\Controllers;

use Illuminate\Http\Request;
use ICTDUInventory\Book;
use Session;

class PublicBookController extends Controller
{
    

    public function show($id)
    {
        $book = Book::find($id);
        return view('books.show')->withBook($book);
    }
}
