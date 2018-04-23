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
        $this->validate($request, [
            'title'                   =>               'required',
            'author'                  =>               'required',
            'date_published'          =>               'required|date|before:tomorrow',
            'bookpic'                 =>               'sometimes|image'
        ]);

        $book = New Book;

        $book->title = $request->title;
        $book->author = $request->author;
        $book->date_published = $request->date_published;
        $book->availability = $request->has('available');
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
        $this->validate($request, [
            'title'                   =>               'required',
            'author'                  =>               'required',
            'date_published'          =>               'required|date|before:tomorrow',
            'bookpic'                 =>               'sometimes|image'       
        ]);

        $book = Book::find($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->date_published = $request->date_published;
        $book->availability = $request->has('available');
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
        $this->validate($request, [
            'title'                   =>               'required',
            'author'                  =>               'required',
            'date_published'          =>               'required|date|before:tomorrow',
            'bookpic'                 =>               'sometimes|image'
        ]);

        $book = New Book;

        $book->title = $request->title;
        $book->author = $request->author;
        $book->date_published = $request->date_published;
        $book->availability = $request->has('available');


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
        $this->validate($request, [
            'title'                   =>               'required',
            'author'                  =>               'required',
            'date_published'          =>               'required|date|before:tomorrow',
            'bookpic'                 =>               'sometimes|image'       
        ]);

        $book = Book::find($id);

        $book->title = $request->title;
        $book->author = $request->author;
        $book->date_published = $request->date_published;
        $book->availability = $request->has('available');
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
        //$subject = Subject::find($id);
        $books = Book::all();
        $qrSelectedArray = array();         
        /*foreach ($books as $book) {             
               $qrArray[$book->id] = $book->name. ' (' .$book->grade_level. ')';
           
        }
*/

       /* for ($i=0; $i < count($_REQUEST)-1 ; $i++) { 
            $qrSelectedArray[$i] = $books[$_REQUEST[$i]]->id;
        }*/
        array_shift($_POST);
        foreach ($_POST as $value) {
          
          //print_r($value);
          $qrSelectedArray[] = $value;

        }   

        //print_r($qrSelectedArray);
        //print_r($_POST['_token']);
        return view('books.printselectedqr')
                    ->with('selectedBooks',$qrSelectedArray);
    }

}
