@extends('layouts.app')

@section('styles')
     <link href="{{ asset('css/home.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Books <small class="muted">All books in the database</small></h1>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{ route('book.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add Book</a>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="container">
                            <ul class="list-inline">
                                <form action="{{ route('paginate.books') }}" method="POST">
                                    {{ csrf_field() }}
                                <li>
                                    <select class="form-control" id="sel1" style="width: 55px;" name="paginate">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </li>
                                <li>
                                    <button type="submit" class="btn btn-default">Submit</button>
                                </li>
                            </form>
                                <li>
                                    records per page
                                </li>
                                <li>
                                    <form class="form-inline float-right" action="/action_page.php">
                                      <div class="form-group">
                                        <input type="text" class="form-control" id="search" placeholder="Search">
                                      </div>
                                      <button type="submit" class="btn btn-default">Submit</button>
                                    </form>
                                </li>
                            </ul>          
                        </div>   
                    </div>
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th style="width:10%" >ID</th>
                            <th style="width:20%" >Title</th>
                            <th style="width:20%" >Author</th>
                            <th style="width:20%" >Published Date</th>
                            <th>Available</th>
                            <th style="width:30%" >Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($books  as $book)
                                  <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ date('M j, Y', strtotime($book->date_published)) }}</td>
                                    <td>@if($book->availability == 1)
                                        {{ 'Yes' }}
                                        @else
                                        {{ 'No' }}
                                        @endif
                                    </td>
                                    <td><a href="#" class="btn btn-default btn-sm"><i class="fas fa-eye"></i> View</a> <a href="#" class="btn btn-default btn-sm"><i class="fas fa-edit"></i> Edit</a> <a href="#" class="btn btn-default btn-sm"><i class="fas fa-trash-alt"></i> Delete</a></td>
                                  </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p>Showing {{ $books->count() }} of {{ $allBooks->count() }}</p>
                    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                {!! $books->links() !!}
        </div>
    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
