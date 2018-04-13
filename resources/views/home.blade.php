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
                                <li>
                                    <select class="form-control" id="sel1" style="width: 55px;">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </li>
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
                            <th style="width:20%" >Published Date (YYYY-MM-DD)</th>
                            <th style="width:30%" >Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($books  as $book)
                                  <tr>
                                    <td>{{ $book->id }}</td>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->author }}</td>
                                    <td>{{ $book->date_published }}</td>
                                    <td><a href="#" class="btn btn-default btn-sm"><i class="fas fa-eye"></i> View</a> <a href="#" class="btn btn-default btn-sm"><i class="fas fa-edit"></i> Edit</a> <a href="#" class="btn btn-default btn-sm"><i class="fas fa-trash-alt"></i> Delete</a></td>
                                  </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <p>Showing 1 to 10 of 1,321,132 entries</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
