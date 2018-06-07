<?php

namespace ICTDUInventory\Http\Controllers;

use Illuminate\Http\Request;
use ICTDUInventory\Book;
use Session;
use ICTDUInventory\Course;

class PublicBookController extends Controller
{
    

    public function show($id)
    {
    	$courses = Course::all();
        $book = Book::find($id);
        return view('books.show')
        	->withBook($book)
        	->with('courses', $courses);
    }
}
