<?php

namespace ICTDUInventory\Http\Controllers;

use Illuminate\Http\Request;
use ICTDUInventory\Book;
use Session;
use Image;
use Storage;
use Hash;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $yearNow = date("Y");
        $this->validate($request, [
            'title'                   =>               'required',
            'author'                  =>               'required',
            'year_published'          =>               'required|integer|between:1900,'.$yearNow,
            'bookpic'                 =>               'sometimes|image'
        ]);

        $book = New Book;

        $book->title = $request->title;
        $book->author = $request->author;
        $book->year_published = $request->year_published;
        $book->availability = $request->has('available');
        $book->with_cd = $request->has('cd');
        if($request->hasFile('bookpic')){
                $image = $request->file('bookpic');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->save($location);
                $oldImage = $book->image; //old imagename

                $book->image = $filename; 
             
        }

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit')
                ->with('book', $book);
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
        $yearNow = date("Y");
        $this->validate($request, [
            'title'                   =>               'required',
            'author'                  =>               'required',
            'year_published'          =>               'required|integer|between:1900,'.$yearNow,
            'bookpic'                 =>               'sometimes|image'       
        ]);

        $book = Book::find($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->year_published = $request->year_published;
        $book->availability = $request->has('available');
        $book->with_cd = $request->has('cd');
        if($request->hasFile('bookpic')){
                $image = $request->file('bookpic');
                $filename = $id . '.' . time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->save($location);
                $oldImage = $book->image; //old imagename

                $book->image = $filename; 

                Storage::delete($oldImage); //delete old image
             
        }
        $book->save();

        Session::flash('success', 'Book successfully changed.');
        return redirect()->route('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        Session::flash('success', 'Book has been deleted.');
        return redirect()->route('home');
    }

    public function storeAndNew(Request $request) 
    {
       $yearNow = date("Y");
        $this->validate($request, [
            'title'                   =>               'required',
            'author'                  =>               'required',
            'year_published'          =>               'required|integer|between:1900,'.$yearNow,
            'bookpic'                 =>               'sometimes|image'
        ]);

        $book = New Book;

        $book->title = $request->title;
        $book->author = $request->author;
        $book->year_published = $request->year_published;
        $book->availability = $request->has('available');
        $book->with_cd = $request->has('cd');


        if($request->hasFile('bookpic')){
                $image = $request->file('bookpic');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->save($location);
                $oldImage = $book->image; //old imagename

                $book->image = $filename; 
             
            }

        $book->save();

        Session::flash('success', 'Book successfully added.');
        return redirect()->route('book.create');
    }

    public function updateAndView(Request $request, $id)
    {
        $yearNow = date("Y");
        $this->validate($request, [
            'title'                   =>               'required',
            'author'                  =>               'required',
            'year_published'          =>               'required|integer|between:1900,'.$yearNow,
            'bookpic'                 =>               'sometimes|image'       
        ]);

        $book = Book::find($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->year_published = $request->year_published;
        $book->availability = $request->has('available');
        $book->with_cd = $request->has('cd');
        if($request->hasFile('bookpic')){
                $image = $request->file('bookpic');
                $filename = $id . '.' . time() . '.' . $image->getClientOriginalExtension();
                $location = public_path('images/' . $filename);
                Image::make($image)->save($location);
                $oldImage = $book->image; //old imagename

                $book->image = $filename; 

                Storage::delete($oldImage); //delete old image
             
        }
        $book->save();

        Session::flash('success', 'Book successfully changed.');
        return redirect()->route('book.show', $book->id);
    }

    public function printBooks() {
      $books = Book::all();
        return view('books.printall')
                ->with('books', $books);
    }

    public function printSelectedBooks(Request $request) {

        $books = Book::all();
        $qrSelectedArray = array();         

        array_shift($_POST);
        foreach ($_POST as $value) {
          

          $qrSelectedArray[] = $value;

        } 

        if (empty($qrSelectedArray)) {
             Session::flash('info', 'Please select a book to print.');
             return redirect()->back();
        }


        return view('books.printselectedqr')
                    ->with('selectedBooks',$qrSelectedArray);
    }

}
